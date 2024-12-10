<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Inertia\Inertia;

class TransactionController extends Controller
{
    protected bool $default_status = true;
    private string $folder = 'Manger/Manage/';


    public function index()
    {
        $transactions = Transaction::paginate(10);

        return Inertia::render($this->folder . 'Transactions/index', [
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
