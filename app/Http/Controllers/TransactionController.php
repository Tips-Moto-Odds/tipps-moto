<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

        $transactions = $transactions->orderBy('created_at','desc')->paginate(15);

        return Inertia::render('Administrator/Transactions/Index',[
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
                'Total Transactions Value' => 'Ksh '.Transaction::where('transaction_status', 'successful')
                    ->whereBetween('created_at', [
                        Carbon::today()->startOfDay(),
                        Carbon::today()->endOfDay()
                    ])->sum('amount'),
                'Pending Transactions Count' => Transaction::where('transaction_status', 'pending')
                    ->whereDate('created_at', Carbon::today())
                    ->count(),
                'Pending Transactions Value' => 'Ksh '.Transaction::where('transaction_status', 'pending')
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
                'Total Transactions Value' => 'Ksh '.Transaction::where('transaction_status', 'successful')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(Carbon::MONDAY),
                        Carbon::now()->endOfWeek()
                    ])->sum('amount'),
                'Pending Transactions Count' => Transaction::where('transaction_status', 'pending')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(Carbon::MONDAY),
                        Carbon::now()->endOfWeek()
                    ])->count(),
                'Pending Transactions Value' => 'Ksh '.Transaction::where('transaction_status', 'pending')
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
                'Total Transactions Value' => 'Ksh '.Transaction::where('transaction_status', 'successful')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])->sum('amount'),
                'Pending Transactions Count' => Transaction::where('transaction_status', 'pending')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])->count(),
                'Pending Transactions Value' => 'Ksh '.Transaction::where('transaction_status', 'pending')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])->sum('amount'),
            ],
            'Grand Total' => [
                'Total Transactions' => Transaction::where('transaction_status', 'successful')->count(),
                'Total Transactions value' => 'Ksh '.Transaction::where('transaction_status', 'successful')->sum('amount'),
                'Pending Transactions Count' => Transaction::where('transaction_status', 'pending')->count(),
                'Pending Transactions Value' => 'Ksh '.Transaction::where('transaction_status', 'pending')->sum('amount'),
            ]
        ];
    }
}
