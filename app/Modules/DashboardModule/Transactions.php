<?php

namespace App\Modules\DashboardModule;

use App\Modules\DashboardModule\Abstract\ChartLoaderAbstract;
use App\Modules\DashboardModule\Traits\ChartLoader;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Transactions extends ChartLoaderAbstract
{
    public string $table = 'transactions';

    public function loadByDates(Carbon|null $from = null, Carbon|null $to = null): array
    {
        // Default to full month if no custom range is provided
        $from = $from ?? $this->startOfMonth;
        $to = $to ?? $this->endOfMonth;

        $transactions = DB::table($this->table)
            ->selectRaw('DATE(created_at) as day,
                 SUM(CASE WHEN transaction_status = "successful" THEN amount ELSE 0 END) as success,
                 SUM(CASE WHEN transaction_status = "pending" THEN amount ELSE 0 END) as pending')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return $this->formatDataForChart($transactions, $from, $to);
    }

    private function formatDataForChart($transactions, $from, $to): array
    {
        $dateRange = collect();
        for ($date = $from->copy(); $date->lte($to); $date->addDay()) {
            $dateRange->push([
                'day' => $date->toDateString(),
                'success' => 0,
                'pending' => 0
            ]);
        }

        return $dateRange->map(function ($item) use ($transactions) {
            $match = $transactions->firstWhere('day', $item['day']);
            return [
                'day' => $item['day'],
                'success' => $match->success ?? 0,
                'pending' => $match->pending ?? 0
            ];
        })->toArray();
    }
}
