<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Jobs\OnitSTKPush;
use App\Models\Subscription;
use App\Models\Transaction;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class SubscriptionController extends Controller
{
    /**
     * @throws \Exception
     */
    public function subscribe(SubscribeRequest $request): \Illuminate\Http\RedirectResponse
    {
        $package_id = $request->input('id');

        //check if user has an active subscription
        $activeSubscription = Subscription::where('user_id', auth()->user()->id)
            ->where('status', 'active')
            ->first();

        //TODO:test active subscription
        //if user has an active subscription, redirect with error
        if ($activeSubscription) {
            return redirect()->back()->with('error', 'You have an active subscription');
        }

        $transaction_code = $this->generateRandomCode();
        $request['transaction_code'] = $transaction_code;

        //create a new transaction
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'currency' => 'KSH',
            'amount' => 1,
            'payment_method' => 'M-Pesa',
            'package_id' => $package_id,
            'transaction_reference' => $transaction_code,
            'transaction_type' => 'subscription',
        ]);

        $onitController = new OnitController();
        $push_stk_result = $onitController->deposit($request,$transaction);

        return redirect()->back()->with('success', 'Subscription request sent. Awaiting confirmation.');
    }

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

    public function unsubscribe(Request $request): \Illuminate\Http\RedirectResponse
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

    private function validateRequest($transaction): bool
    {
        $transactionController = new TransactionController();
        return $transactionController->validatePayment($transaction);
    }


    public function generateRandomCode($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
