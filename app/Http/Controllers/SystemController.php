<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Mockery\Exception;

class SystemController extends Controller
{

    public function index()
    {
        return Inertia::render('Dashboards/Administrator/System/Index');
    }

    public function syncData(Request $request)
    {
        $model = $request->input('model');

        // Define model-to-table mapping
        $models = [
            'Accounts' => ['table' => 'users', 'model' => \App\Models\User::class],
            'Matches' => ['table' => 'matches', 'model' => \App\Models\Matches::class],
            'Tips' => ['table' => 'tips', 'model' => \App\Models\Tips::class],
            'Selection' => ['table' => 'selections', 'model' => \App\Models\Selection::class],
        ];

        if (!isset($models[$model])) {
            abort(403, '❌ Action Not Allowed for Unknown Model.');
        }

        $table = $models[$model]['table'];
        $modelClass = $models[$model]['model'];

        try {

            // Fetch records from the live database
            $live_records = DB::connection('live_db')->table($table)->get();

            // Disable foreign key checks before truncating
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($table)->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Insert records from live_db while keeping original IDs
            foreach ($live_records as $record) {
                $modelClass::insert(json_decode(json_encode($record), true)); // Ensure proper array conversion
            }

            // Reset auto-increment if records exist
            $maxId = DB::table($table)->max('id');
            if ($maxId) {
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = " . ($maxId + 1) . ";");
            }

            // Commit transaction if everything is successful

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
