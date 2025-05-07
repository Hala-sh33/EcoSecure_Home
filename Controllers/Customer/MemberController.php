<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = auth()->user()->members;
        return view('customer.members.index', compact('members'));
    }

    public function create()
    {
        return view('customer.members.create', ['member' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'userName' => 'required|string|max:100',
            'homeID' => 'nullable|exists:Home,homeID',
            'is_emergency_contact' => 'boolean'
        ]);
        $member = auth()->user()->members()->create([
            'userName' => $request->userName,
            'homeID' => $request->homeID,
            'is_emergency_contact' => $request->is_emergency_contact ?? false
        ]);
        return redirect()->route('customer.members.index')
            ->with('success', 'Member added successfully with ID: ' . $member->memberID);
    }

    public function edit(Member $member)
    {
        return view('customer.members.edit', compact('member'));
    }


    public function update(Request $request, Member $member)
    {
        $request->validate([
            'userName' => 'required|string|max:100',
            'homeID' => 'nullable|exists:Home,homeID',
            'is_emergency_contact' => 'boolean'
        ]);

        $member->update([
            'userName' => $request->userName,
            'homeID' => $request->homeID,
            'is_emergency_contact' => $request->is_emergency_contact ?? false
        ]);

        return redirect()->route('customer.members.index')
            ->with('success', 'Member updated successfully (ID: ' . $member->memberID . ')');    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('customer.members.index')->with('success', 'Member deleted successfully.');
    }
}
