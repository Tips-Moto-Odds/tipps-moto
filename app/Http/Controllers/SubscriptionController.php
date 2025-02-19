<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Jobs\OnitSTKPush;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class SubscriptionController extends Controller
{
    /**
     * @throws Exception
     */
    public function subscribe(SubscribeRequest $request): RedirectResponse
    {
        $package_id = $request->input('id');

        $transaction_code = $this->generateRandomCode();
        $request['transaction_code'] = $transaction_code;
        $price = Packages::where('name',$request->input('package'))->first();

        //create a new transaction
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'currency' => 'KSH',
            'amount' => number_format($price->price * 1.16, 2),
            'payment_method' => 'M-Pesa',
            'package_id' => $package_id,
            'transaction_reference' => $transaction_code,
            'transaction_type' => 'subscription',
        ]);

        $onitController = new OnitController();
        $push_stk_result = $onitController->deposit($request,$transaction);

        return redirect()->back()->with('success', 'Subscription request sent. Awaiting confirmation.');
    }

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

    //TODO:No action
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
