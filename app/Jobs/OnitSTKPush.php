<?php

namespace App\Jobs;

use App\Http\Controllers\OnitController;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OnitSTKPush implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $requestData;
    protected $transaction;

    /**
     * Create a new job instance.
     */
    public function __construct($requestData, $transaction)
    {
        $this->requestData = $requestData;
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     */
    public function handle(Request $request, Transaction $transaction): void
    {
        Log::info('here');
        $onitController = new OnitController();
        $push_stk_result = $onitController->deposit($this->requestData);

        Log::info($push_stk_result);
        Log::info($transaction);

        if ($push_stk_result->statusCode === '0001') {
            $this->transaction->status = 'pending';
        } else {
            $this->transaction->status = 'failed';
        }
        $this->transaction->save();
    }
}
