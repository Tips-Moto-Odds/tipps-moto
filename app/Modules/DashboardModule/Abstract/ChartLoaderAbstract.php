<?php

namespace App\Modules\DashboardModule\Abstract;

use App\Modules\DashboardModule\Traits\ChartLoader;
use Carbon\Carbon;

abstract class ChartLoaderAbstract implements ChartLoader
{
    public Carbon $startOfWeek;
    public Carbon $endOfWeek;
    public Carbon $startOfMonth;
    public Carbon $endOfMonth;
    public Carbon $startOfYear;
    public Carbon $endOfYear;

    public function __construct()
    {
        $this->startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $this->endOfWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY);
        $this->startOfMonth = Carbon::now()->startOfMonth();
        $this->endOfMonth = Carbon::now()->endOfMonth();
        $this->startOfYear = Carbon::now()->startOfYear();
        $this->endOfYear = Carbon::now()->endOfYear();
    }

    public function getWeekly(): array
    {
        return $this->loadByDates($this->startOfWeek, $this->endOfWeek);
    }

    public function getMonthly(): array
    {
        return $this->loadByDates($this->startOfMonth, $this->endOfMonth);
    }

    public function getAnnually(): array
    {
        return $this->loadByDates($this->startOfYear, $this->endOfYear);
    }
}
