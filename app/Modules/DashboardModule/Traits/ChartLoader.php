<?php

namespace App\Modules\DashboardModule\Traits;

use Carbon\Carbon;

interface ChartLoader
{
    public function loadByDates(Carbon|null $from = null, Carbon|null $to = null): array;
    public function getWeekly(): array;
    public function getMonthly(): array;
    public function getAnnually(): array;
}
