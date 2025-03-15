<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Modules\DashboardModule\Subscriptions;
use App\Modules\DashboardModule\Transactions;
use App\Models\Transaction as TransactionModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        return Inertia::render('AdminDashboard', [
            'label_data' => [
                'users' => $this->stats()['users'],
                'payments' => $this->stats()['payments'],
                'model' => $this->stats()['model']
            ],
            'chart_data' => $this->getChartData($request),
            'recent_purchases' => $this->getRecentTransactions()
        ]);
    }

    public function stats(): array
    {
        $users = collect(User::all())->count();

        $payments = TransactionModel::where('transaction_status','successful')->sum('amount');

        return [
            'users' => $users,
            'payments' => $payments,
            'model' => []
        ];
    }

    public function getChartData(Request $request): array
    {
        $modelType = $request->input('record', 'Transactions'); // Default model is transactions
        $period = $request->input('period', 'weekly');
        $from = $request->input('from') ? Carbon::parse($request->input('from')) : null;
        $to = $request->input('to') ? Carbon::parse($request->input('to')) : null;

        // Dynamically select the model class
        $loader = match ($modelType) {
            'Subscriptions' => new Subscriptions(),
//            'users' => new Users(),
//            'purchased_packages' => new PurchasedPackages(),
            default => new Transactions()
        };

        return match ($period) {
            'Weekly' => $loader->getWeekly(),
            'Monthly' => $loader->getMonthly(),
            'Annually' => $loader->getAnnually(),
            'Custom' => $loader->loadByDates($from, $to),
            default => $loader->getWeekly(),
        };
    }

    private function getRecentTransactions()
    {
        return TransactionModel::where('transaction_status', 'successful')
            ->with(['user', 'package']) // Load related User & Package models
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }
}
