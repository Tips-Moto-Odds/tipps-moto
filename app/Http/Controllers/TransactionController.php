<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('users as u', 'transactions.user_id', '=', 'u.id')
            ->join('packages as p', 'transactions.package_id', '=', 'p.id')
            ->select(
                'transactions.*',
                'u.name as user_name',
                'u.email as user_email',
                'p.name as package_name'
            );



        $transactions = $transactions->orderBy('created_at','desc')->paginate(15);

        return Inertia::render('Dashboards/Manager/Transactions/Index',[
            'transactions' => $transactions
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
}
