<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    private array $packages = [
        array('name' => 'Daily', 'price' => 150),
        array('name' => 'Weekly', 'price' => 700),
        array('name' => 'Monthly', 'price' => 2500)
    ];

    /**
     * @throws \Exception
     */
    public function subscribe(Request $request)
    {
        //TODO:validate
        $package = $request->input('package');

        //check if package is in the list
        if (!in_array($package, array_column($this->packages, 'name'))) {
            return redirect()->back()->with('error', 'Invalid package selected');
        }
        //check if user has an active subscription
        $activeSubscription = Subscription::where('user_id', auth()->user()->id)
            ->where('status', 'active')
            ->first();

        //if user has an active subscription, redirect with error
        if ($activeSubscription) {
            return redirect()->back()->with('error', 'You have an active subscription');
        }

        //create a new transaction
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'currency' => 'KSH',
            'amount' => $this->getPackagePrice($package),
            'payment_method' => 'M-Pesa',
            'subscription_package' => $package,
            'transaction_reference' => "reference",
            'transaction_type' => 'subscription',
            'transaction_date' => now()->format('Y-m-d'),
            'transaction_time' => now()->format('H:i:s'),
        ]);


        if (!$this->validateRequest($transaction)) {
            //abort
            session()->flash('error', 'Transaction failed');
            return redirect()->back()->with('error', 'Transaction failed');
        }

        //self invoking function to find the end date given the plan

        $endDate = null;

        if ($package == 'Daily') {
            $endDate = now()->addDays(1);
        } elseif ($package == 'Weekly') {
            $endDate = now()->addWeeks(1);
        } elseif ($package == 'Monthly') {
            $endDate = now()->addMonths(1);
        }


        $subscription = new Subscription();
        $subscription->user_id = auth()->user()->id;
        $subscription->plan = $package;
        $subscription->start_date = now()->format('Y-m-d');
        $subscription->end_date = $endDate->format('Y-m-d');
        $subscription->status = 'active';
        $subscription->transaction_id = $transaction->id;

        $subscription->save();

        return redirect()->back()->with('success', 'Subscription successful');
    }


    public function unsubscribe(Request $request)
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

    /**
     * @throws \Exception
     */
    private function getPackagePrice(mixed $package)
    {
        foreach ($this->packages as $p) {
            if ($p['name'] == $package) {
                return $p['price'];
            }
        }

        throw new \Exception('Invalid package selected');
    }

    private function validateRequest($transaction): bool
    {
        //call validatePayment in Transaction controller
        $transactionController = new TransactionController();
        return $transactionController->validatePayment($transaction);
    }
}
