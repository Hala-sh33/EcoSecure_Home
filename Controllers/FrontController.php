<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ContactRequest;
use App\Models\Feedback;
use App\Models\Region;
use App\Models\RequestModel;
use App\Models\Resource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function listResources(Request $request)
    {
        $query = Resource::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $resources = $query->paginate(12);
        return view('front.resources.index', compact('resources'));
    }

    public function showResource($id)
    {
        $resource = Resource::with(['donor', 'feedback.beneficiary'])->findOrFail($id);
        return view('front.resources.show', compact('resource'));
    }

    public function requestResource(Request $request, $id)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:255',
        ]);
        if (!Auth::check() || Auth::user()->role !== 'beneficiary') {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول كمستفيد لإتمام الطلب.');
        }
        RequestModel::create([
            'resource_id' => $id,
            'donor_id' => Resource::findOrFail($id)->donor_id,
            'beneficiary_id' => Auth::user()->beneficiary->beneficiary_id,
            'status' => 'pending',
            'date' => now()->toDateString(),
            'delivery_address' => $request->delivery_address,
        ]);

        return redirect()->back()->with('success', 'تم تقديم الطلب بنجاح.');
    }

    /**
     * Submit feedback for a resource
     */
    public function addFeedback(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:500',
        ]);

        if (!Auth::check() || Auth::user()->role !== 'beneficiary') {
            toastr()->error('يجب تسجيل الدخول كمستفيد لإضافة تقييم.');

            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول كمستفيد لإضافة تقييم.');
        }

        Feedback::create([
            'donor_id' => Resource::findOrFail($id)->donor_id,
            'beneficiary_id' => Auth::user()->beneficiary->beneficiary_id,
            'resource_id' => $id,
            'rate' => $request->rating,
            'comment' => $request->review_text,
            'dateTime' => now(),
        ]);

        return redirect()->back()->with('success', 'تم إضافة التقييم بنجاح.');
    }

    /**
     * Submit a complaint against a donor
     */
    public function submitComplaint(Request $request, $donorId)
    {
        $request->validate([
            'description' => 'required|string|max:500',
        ]);

        if (!Auth::check() || Auth::user()->role !== 'beneficiary') {
            toastr()->error('يجب تسجيل الدخول كمستفيد لتقديم شكوى.');
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول كمستفيد لتقديم شكوى.');
        }

        Complaint::create([
            'donor_id' => $donorId,
            'beneficiary_id' => Auth::user()->beneficiary->beneficiary_id,
            'description' => $request->description,
            'status' => 'open',
            'date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'تم إرسال الشكوى بنجاح.');
    }

    public function beneficiaryProfile()
    {
        $beneficiary = Auth::user()->beneficiary;
        $requests = RequestModel::where('beneficiary_id', $beneficiary->beneficiary_id)->get();
        $complaints = Complaint::where('beneficiary_id', $beneficiary->beneficiary_id)->get();
        $feedbacks = Feedback::where('beneficiary_id', $beneficiary->beneficiary_id)->get();

        return view('front.beneficiary.profile', compact('beneficiary', 'requests', 'complaints', 'feedbacks'));
    }

    public function deleteFeedback($id)
    {
        Feedback::where('feedback_id', $id)->delete();
        return redirect()->back()->with('success', 'تم حذف التقييم بنجاح.');
    }


    public function updateBeneficiaryProfile(Request $request)
    {
        $beneficiary = Auth::user()->beneficiary;

        // Validate form input
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id() . ',user_id',
            'phone' => ['required', 'regex:/^(05)[0-9]{8}$/'],
            'address' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'phone.regex' => 'رقم الجوال يجب أن يبدأ بـ 05 ويتكون من 10 أرقام.',
        ]);
        $beneficiary->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $user = Auth::user();
        $user->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('front.beneficiary.profile')->with('success', 'تم تحديث البيانات بنجاح.');
    }

}
