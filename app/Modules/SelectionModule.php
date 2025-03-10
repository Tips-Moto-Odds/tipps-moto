<?php

namespace App\Modules;

use App\Models\Selection;
use Illuminate\Support\Facades\Log;

class SelectionModule
{
    public function updateSelection($packageId, $tips)
    {
        dd("updating");
        Log::info("Updating Selection: Package ID: $packageId");

        $selection = Selection::updateOrCreate(
            ['package_id' => $packageId, 'date_for' => now()->toDateString()],
            ['status' => 1]
        );

        $existingTips = json_decode($selection->tips, true) ?? [];
        $mergedTips = array_merge($existingTips, $tips);

        $selection->update(['tips' => json_encode($mergedTips)]);

        Log::info("Updated Selection: Package ID: $packageId | Tips: " . json_encode($mergedTips));
    }
}
