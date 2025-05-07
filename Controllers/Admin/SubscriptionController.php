<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function all()
    {
        $subscriptions = Subscription::with('account')->get();
        return view('dashboard.subscriptions.all', compact('subscriptions'));
    }


    public function index($accountID)
    {
        $customer = Account::findOrFail($accountID);
        $subscriptions = Subscription::where('accountID', $accountID)->get();

        return view('dashboard.subscriptions.index', compact('customer', 'subscriptions'));
    }

    public function create($accountID)
    {
        $customer = Account::findOrFail($accountID);
        $homes = $customer->homes;
        return view('dashboard.subscriptions.create', compact('customer', 'homes'));
    }

    public function store(Request $request, $accountID)
    {
        $request->validate([
            'homeID' => 'required|exists:Home,homeID',
            'PaymentMethod' => 'required|in:cash,credit,paypal',
            'paymentAmount' => 'required|numeric|min:0',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'subscriptionStatus' => 'required|in:active,expired,cancelled',
        ]);

        Subscription::create([
            'homeID' => $request->homeID,
            'accountID' => $accountID,
            'PaymentMethod' => $request->PaymentMethod,
            'paymentAmount' => $request->paymentAmount,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'subscriptionStatus' => $request->subscriptionStatus,
        ]);

        return redirect()->route('admin.subscriptions.index', $accountID)->with('success', 'Subscription added successfully');
    }


    public function edit(Subscription $subscription)
    {
        $customer = Account::findOrFail($subscription->accountID);
        $homes = $customer->homes;
        return view('dashboard.subscriptions.edit', compact('subscription', 'customer', 'homes'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'homeID' => 'required|exists:Home,homeID',
            'PaymentMethod' => 'required',
            'paymentAmount' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'subscriptionStatus' => 'required|in:active,expired,canceled',
        ]);

        $subscription->update($validated);
        return redirect()->route('admin.subscriptions.index', $subscription->accountID)->with('success', 'Subscription updated successfully');
    }

    public function destroy(Subscription $subscription)
    {
        $accountID = $subscription->accountID;
        $subscription->delete();
        return redirect()->route('admin.subscriptions.index', $accountID)->with('success', 'Subscription deleted successfully');
    }


    public function renew(Subscription $subscription)
    {
        $new = $subscription->replicate();
        $new->startDate = now();
        $new->endDate = now()->addMonth();
        $new->subscriptionStatus = 'active';
        $new->save();
        return redirect()->route('admin.subscriptions.index', $subscription->accountID)->with('success', 'Subscription renewed successfully.');
    }

}
