<?php

namespace App\Modules\DashboardModule;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Transactions
{
    public function loadData($view = 'default'): array
    {
        $thisWeeksData = $this->getWeeklyTransactions();
        $thisMonthsData = $this->getMonthlyTransactions();

//        if ($view === 'default') {
//            return $thisWeeksData;
//        }

        return $thisMonthsData;
    }

    public function getWeeklyTransactions(): array
    {
        // Get start and end of the week (Sunday - Saturday)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY);

        // Fetch transactions grouped by day
        $transactions = DB::table('transactions')
            ->selectRaw('DAYOFWEEK(created_at) - 1 as day,
                     SUM(CASE WHEN transaction_status = "successful" THEN amount ELSE 0 END) as success,
                     SUM(CASE WHEN transaction_status = "pending" THEN amount ELSE 0 END) as pending')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Default structure for the week (ensures all days are present)
        $weeklyData = [];
        for ($i = 0; $i < 7; $i++) {
            $weeklyData[$i] = [
                'day' => $i,
                'success' => 0,
                'pending' => 0
            ];
        }

        // Merge fetched data with default structure
        foreach ($transactions as $transaction) {
            $weeklyData[$transaction->day] = [
                'day' => $transaction->day,
                'success' => $transaction->success,
                'pending' => $transaction->pending
            ];
        }

        return $weeklyData;
    }
    public function getMonthlyTransactions(): array
    {
        // Get start and end of the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Fetch transactions grouped by day
        $transactions = DB::table('transactions')
            ->selectRaw('DATE(created_at) as day,
                 SUM(CASE WHEN transaction_status = "successful" THEN amount ELSE 0 END) as success,
                 SUM(CASE WHEN transaction_status = "pending" THEN amount ELSE 0 END) as pending')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Default structure for the month (ensures all days are present)
        $daysInMonth = Carbon::now()->daysInMonth; // Get total number of days in the current month
        $monthlyData = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::now()->startOfMonth()->addDays($i - 1)->toDateString(); // Generate date format YYYY-MM-DD
            $monthlyData[$date] = [
                'day' => $date,
                'success' => 0,
                'pending' => 0
            ];
        }

        // Merge fetched data with default structure
        foreach ($transactions as $transaction) {
            $monthlyData[$transaction->day] = [
                'day' => $transaction->day,
                'success' => $transaction->success,
                'pending' => $transaction->pending
            ];
        }

        return array_values($monthlyData); // Ensure indexed array for Vue
    }

}
