<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Inertia\Inertia;
    use Inertia\Response;
    use Illuminate\Http\Request;
    use Illuminate\Database\Eloquent\Builder;
    use Symfony\Component\HttpFoundation\StreamedResponse;


    class MarketingController extends Controller {

        public function index(Request $request): Response
        {
            $MarketingData = $this
                ->applyMarketingFilters($request)
                ->paginate(15)
                ->withQueryString();

            return Inertia::render('Administrator/Marketing/Index', [
                'MarketingData' => $MarketingData,
                'search'        => $request->input('search', ''),
                'filter'        => [
                    'segmentation' => $request->input('filter.segmentation', ''),
                ],
                'stats'         => [
                    'TotalUsers' => User::count(),
                ],
            ]);
        }

        public function export(Request $request): StreamedResponse
        {
            $users = $this->applyMarketingFilters($request)->get(['id', 'name', 'email', 'phone']);

            $headers = [
                'Content-Type'        => 'text/csv',
                'Content-Disposition' => 'attachment; filename=marketing_export.csv',
            ];

            return response()->stream(function () use ($users) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'Successful Purchases']);

                foreach ($users as $user) {
                    fputcsv($handle, [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->phone,
                        $user->successful_txn_count ?? 0,
                    ]);
                }

                fclose($handle);
            }, 200, $headers);
        }

        private function applyMarketingFilters(Request $request): Builder
        {
            $segmentation = $request->input('filter.segmentation', '');
            $search = $request->input('search', '');

            $query = User::query()
                         ->withCount(['transactions as successful_txn_count' => function ($q) {
                             $q->where('transaction_status', 'successful');
                         }]);

            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q
                        ->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
            }

            if ($segmentation === 'not_bought') {
                $query->whereDoesntHave('transactions', function ($q) {
                    $q->where('transaction_status', 'successful');
                });
            } elseif ($segmentation === 'bough_once') {
                $query->having('successful_txn_count', '=', 1);
            } elseif ($segmentation === 'bought_at_least_once') {
                $query->having('successful_txn_count', '>', 1);
            }

            return $query;
        }


    }
