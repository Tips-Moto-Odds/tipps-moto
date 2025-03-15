<?php

namespace App\Modules\DashboardModule;

use App\Modules\DashboardModule\Abstract\ChartLoaderAbstract;
use App\Modules\DashboardModule\Traits\ChartLoader;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Subscriptions extends ChartLoaderAbstract
{
    public string $table = 'transactions';

    public function loadByDates(Carbon|null $from = null, Carbon|null $to = null): array
    {
        // Default to full month if no custom range is provided
        $from = $from ?? $this->startOfMonth;
        $to = $to ?? $this->endOfMonth;


        $subscription = DB::table('transactions')
            ->selectRaw('DATE(created_at) as day,
                 COUNT(CASE WHEN transaction_status = "successful" THEN 1 ELSE NULL END) as success_count,
                 COUNT(CASE WHEN transaction_status = "pending" THEN 1 ELSE NULL END) as pending_count')
            ->whereBetween('created_at', [$from,$to ])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return $this->formatDataForChart($subscription, $from, $to);
    }

    private function formatDataForChart($subscriptions, $from, $to): array
    {
        $dateRange = collect();

        for ($date = $from->copy(); $date->lte($to); $date->addDay()) {
            $dateRange->push([
                'day' => $date->toDateString(),
                'success_count' => 0,
                'pending_count' => 0
            ]);
        }

        return $dateRange->map(function ($item) use ($subscriptions) {
            $match = $subscriptions->firstWhere('day', $item['day']);
            return [
                'day' => $item['day'],
                'success_count' => $match->success_count ?? 0,
                'pending_count' => $match->pending_count ?? 0
            ];
        })->toArray();
    }

}
