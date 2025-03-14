<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Modules\DashboardModule\Transactions;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('AdminDashboard', [
            'label_data' => [
                'users' => $this->stats()['users'],
                'model' => $this->stats()['model'],
                'payments' => $this->stats()['payments']
            ],
            'chart_data' => $this->getChartData()
        ]);
    }

    public function Stats(): array
    {
        $users = User::all();

        return [
            'users' => $users,
            'model' => [],
            'payments' => []
        ];
    }

    public function getChartData(): array
    {
        $loader = new Transactions();

        return $loader->loadData();
    }


}
