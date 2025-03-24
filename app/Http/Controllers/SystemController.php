<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SystemController extends Controller
{
    public function index()
    {
        return Inertia::render('Administrator/System/Index');
    }

    public function syncData(Request $request)
    {
        $model = $request->input('model');

        $models = [
            'Accounts' => ['table' => 'users', 'model' => \App\Models\User::class],
            'Matches' => ['table' => 'matches', 'model' => \App\Models\Matches::class],
            'Tips' => ['table' => 'tips', 'model' => \App\Models\Tips::class],
            'Selection' => ['table' => 'selections', 'model' => \App\Models\Selection::class],
            'Transactions' => ['table' => 'transactions', 'model' => \App\Models\Transaction::class],
            'Subscriptions' => ['table' => 'subscriptions', 'model' => \App\Models\Subscription::class],
        ];

        if (!isset($models[$model])) {
            abort(403, '❌ Action Not Allowed for Unknown Model.');
        }

        $table = $models[$model]['table'];
        $modelClass = $models[$model]['model'];

        try {
            $live_records = DB::connection('live_db')->table($table)->get();

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($table)->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            foreach ($live_records as $record) {
                $modelClass::insert(json_decode(json_encode($record), true));
            }

            $maxId = DB::table($table)->max('id');
            if ($maxId) {
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = " . ($maxId + 1) . ";");
            }

            return response()->json([
                'status' => true,
                'message' => "✅ Local $model table was successfully updated."
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status' => false,
                'message' => "❌ Sync failed: " . $error->getMessage()
            ], 500);
        }
    }
}
