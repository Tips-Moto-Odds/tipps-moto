<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SubscriptionController extends Controller
{
    //TODO:No action
    public function activateSubscription(Request $request)
    {
        $endDate = null;

        $package = null;

        if ($package == 'Daily') {
            $endDate = now()->addDays(1);
        } elseif ($package == 'Weekly') {
            $endDate = now()->addWeeks(1);
        }

        $subscription = new Subscription();
        $subscription->user_id = auth()->user()->id;
        $subscription->plan = $package;
        $subscription->start_date = now()->format('Y-m-d');
        $subscription->end_date = $endDate->format('Y-m-d');
        $subscription->status = 'active';
//        $subscription->transaction_id = $transaction->id;

        $subscription->save();
    }

    //TODO:No action
    public function unsubscribe(Request $request): RedirectResponse
    {
        //get password from request
        $request->validate([
            'password' => 'required',
        ]);

        //get validated passwords from request
        $password = $request->input('password');

        //check if password is correct use hash check
        if (!Hash::check($password, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect password');
        }

        //check if user has an active subscription
        $subscription = Subscription::where('user_id', auth()->user()->id)
            ->where('status', 'active')
            ->first();

        if (!$subscription) {
            return redirect()->back()->with('error', 'You do not have an active subscription');
        }

        $subscription->status = 'cancelled';
        $subscription->save();

        return redirect()->back()->with('success', 'Subscription cancelled successfully');
    }



}
