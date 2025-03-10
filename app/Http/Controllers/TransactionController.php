<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Inertia\Inertia;

class TransactionController extends Controller
{
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
