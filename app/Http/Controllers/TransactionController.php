<?php

namespace App\Http\Controllers;

use App\Models\AccountBalance;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;


class TransactionController extends Controller
{

    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('users as u', 'transactions.user_id', '=', 'u.id')
            ->join('packages as p', 'transactions.package_id', '=', 'p.id')
            ->select('transactions.*', 'u.name as user_name', 'u.email as user_email', 'p.name as package_name');

        $stats = $this->getTransactionsStats();

        $transactions = $transactions->orderBy('created_at', 'desc')->paginate(15);

        return Inertia::render('Administrator/Transactions/Index', [
            'transactions' => $transactions,
            'stats' => $stats
        ]);
    }

    public function validatePayment(Transaction $transaction): bool
    {
        $transaction = $transaction->refresh();

        if ($this->default_status) {
            $transaction->transaction_status = 'success';
        } else {
            $transaction->transaction_status = 'failed';
        }

        return $this->default_status;
    }

    public function getTransactionsStats(): array
    {
        return [
            'Daily' => [
                'Transactions Count Today' => Transaction::where('transaction_status', 'successful')
                    ->whereDate('created_at', Carbon::today())
                    ->count(),
                'Total Transactions Value' => 'Ksh ' . Transaction::where('transaction_status', 'successful')
                        ->whereBetween('created_at', [
                            Carbon::today()->startOfDay(),
                            Carbon::today()->endOfDay()
                        ])->sum('amount'),
                'Pending Transactions Count' => Transaction::where('transaction_status', 'pending')
                    ->whereDate('created_at', Carbon::today())
                    ->count(),
                'Pending Transactions Value' => 'Ksh ' . Transaction::where('transaction_status', 'pending')
                        ->whereBetween('created_at', [
                            Carbon::today()->startOfDay(),
                            Carbon::today()->endOfDay()
                        ])->sum('amount'),
            ],
            'Weekly' => [
                'Transactions Count This Week' => Transaction::where('transaction_status', 'successful')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(Carbon::MONDAY),
                        Carbon::now()->endOfWeek()
                    ])->count(),
                'Total Transactions Value' => 'Ksh ' . Transaction::where('transaction_status', 'successful')
                        ->whereBetween('created_at', [
                            Carbon::now()->startOfWeek(Carbon::MONDAY),
                            Carbon::now()->endOfWeek()
                        ])->sum('amount'),
                'Pending Transactions Count' => Transaction::where('transaction_status', 'pending')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(Carbon::MONDAY),
                        Carbon::now()->endOfWeek()
                    ])->count(),
                'Pending Transactions Value' => 'Ksh ' . Transaction::where('transaction_status', 'pending')
                        ->whereBetween('created_at', [
                            Carbon::now()->startOfWeek(Carbon::MONDAY),
                            Carbon::now()->endOfWeek()
                        ])->sum('amount'),
            ],
            'Monthly' => [
                'Transactions Count This Month' => Transaction::where('transaction_status', 'successful')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])->count(),
                'Total Transactions Value' => 'Ksh ' . Transaction::where('transaction_status', 'successful')
                        ->whereBetween('created_at', [
                            Carbon::now()->startOfMonth(),
                            Carbon::now()->endOfMonth()
                        ])->sum('amount'),
                'Pending Transactions Count' => Transaction::where('transaction_status', 'pending')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])->count(),
                'Pending Transactions Value' => 'Ksh ' . Transaction::where('transaction_status', 'pending')
                        ->whereBetween('created_at', [
                            Carbon::now()->startOfMonth(),
                            Carbon::now()->endOfMonth()
                        ])->sum('amount'),
            ],
            'Grand Total' => [
                'Total Transactions' => Transaction::where('transaction_status', 'successful')->count(),
                'Total Transactions value' => 'Ksh ' . Transaction::where('transaction_status', 'successful')->sum('amount'),
                'Pending sTransactions Count' => Transaction::where('transaction_status', 'pending')->count(),
                'Pending Transactions Value' => 'Ksh ' . Transaction::where('transaction_status', 'pending')->sum('amount'),
            ]
        ];
    }

    public function confirmTinyPesaPayment(Request $request): false|string
    {
        $transactionCode = $request->input('transactionCode');
        $packageName = $request->input('packageName');
        //TODO::check if a transaction exists
        $transactionCodeExist = true;


        if ($transactionCodeExist) {
            $is_subscription_added = $this->addSubscription($packageName, $transactionCode);

            if ($is_subscription_added) {
                return json_encode([
                    'status' => true,
                ]);
            } else {
                return json_encode([
                    'status' => false,
                    'message' => 'Transaction not found',
                ]);
            }

        } else {
            return json_encode([
                'status' => false,
                'message' => 'Transaction not found',
            ]);
        }
    }


    public function payWithAvailableBalance(Request $request): false|string
    {
        $packageName = $request->input('packageName');
        $transactionCode = 'TXN_' . time() . '_' . Str::random(8);
        $user = Auth::user();
        $balance = $user->latest_balance_value ?? 0;

        if ($user && ($balance && $balance != 0)) {
            $price = Packages::where('name', $packageName)->first()->price;
            $tax = Packages::where('name', $packageName)->first()->tax;
            $packageID = Packages::where('name', $packageName)->first()->id;
            $amount = $price + $tax;

            $this->addInternalTransaction('KES', $amount, $packageID, $transactionCode);
            $this->updateAccountBalance($amount, "Purchased package: " . $packageName, $transactionCode);
            $this->addSubscription($packageName, $transactionCode);

            return json_encode([
                "status" => true,
                "message" => "Subscription Purchased",
            ]);
        }

        return json_encode([
            "status" => false,
            "message" => "Error processing payment",
        ]);
    }

    private function addSubscription(string $packageName, string $transactionCode): Subscription
    {
        $package = Packages::where('name', $packageName)->firstOrFail();

        $startDate = now();

        $endDate = $startDate->copy()->addDays($package->period);

        $subscription = new Subscription();
        $subscription->user_id = Auth::User()->id;
        $subscription->package_id = $package->id;
        $subscription->start_date = $startDate;
        $subscription->end_date = $endDate;
        $subscription->status = 'active';
        $subscription->transaction_id = $transactionCode;

        $subscription->save();

        return $subscription;

    }

    private function addInternalTransaction($currency, $amount, $packageId, $transactionCode): void
    {
        $transaction = new Transaction();

        $transaction->user_id = Auth::user()->id;
        $transaction->currency = $currency;
        $transaction->amount = $amount;
        $transaction->payment_method = "Internal";
        $transaction->package_id = $packageId;
        $transaction->transaction_reference = $transactionCode;
        $transaction->transaction_type = 'subscription';
        $transaction->transaction_status = 'successful';
        $transaction->transaction_date = now()->toDateString();
        $transaction->transaction_time = now()->toTimeString();
        $transaction->transaction_description = 'Purchased a subscription with internal balance';

        $transaction->save();

    }

    private function updateAccountBalance($amount, $reason, $reference)
    {
        // Get the current balance for the user
        $currentBalance = AccountBalance::where('user_id', Auth::user()->id)->latest()->first();
        $balanceAfter = $currentBalance->balance_after - $amount;

        // Create a new record for the account balance update
        $accountBalance = new AccountBalance();
        $accountBalance->user_id = Auth::user()->id;
        $accountBalance->amount = $amount;
        $accountBalance->balance_after = $balanceAfter;
        $accountBalance->reason = $reason;
        $accountBalance->reference = $reference;

        $accountBalance->save();
    }


}
