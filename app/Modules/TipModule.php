<?php

namespace App\Modules;

use App\Models\Packages;
use App\Models\Tips;
use App\Models\Selection;
use Illuminate\Support\Facades\Log;

class TipModule
{
    public function processTips($matchId, $tipsList, $confidenceLevel, $isJackpot, $jackpotTag): array
    {
        $tipsToStore = [];

        foreach ($tipsList as $type => $tip) {
            switch ($type) {
                case '1_X_2':
                case '1X_X2_12':
                    if ($isJackpot && $type == '1_X_2') {
                        $prediction = $this->processJackpotTip($matchId, $type, $tip, $confidenceLevel);
                        $jackpotPackage = $this->getJackpotPackage($jackpotTag);


                        if ($jackpotPackage) {
                            $this->addToPackage($matchId, $type, $prediction, $confidenceLevel, $jackpotPackage);
                        }
                    } elseif ($isJackpot && $type == '1X_X2_12') {
                        $prediction = $this->processFullTimeScoreTip($matchId, $type, $tip, $confidenceLevel);
                    } else {
                        $prediction = $this->processFullTimeScoreTip($matchId, $type, $tip, $confidenceLevel);
                        $this->addToPackage($matchId, $type, $prediction, $confidenceLevel, 'Full Time Scores Daily');
                        $this->addToPackage($matchId, $type, $prediction, $confidenceLevel, 'Full Time Scores Weekly');
                    }
                    $tipsToStore[$type] = $prediction;
                    break;

                case 'GG_NG':
                    if ($isJackpot) {
                        break;
                    }
                    $prediction = $this->processGGNGTip($matchId, $tip, $confidenceLevel);
                    $tipsToStore[$type] = $prediction;
                    break;

                case 'Over/Under':
                    if ($isJackpot) {
                        break;
                    }
                    $prediction = $this->processOverUnderTip($matchId, $tip, $confidenceLevel);
                    $this->addToPackage($matchId, 'Over/Under', $prediction, $confidenceLevel, 'Over/Under Market Daily');
                    $this->addToPackage($matchId, 'Over/Under', $prediction, $confidenceLevel, 'Over/Under Market Weekly');
                    $tipsToStore[$type] = $prediction;
                    break;

                default:
                    Log::warning("Unknown Tip Type: Match ID: $matchId | Type: $type");
                    break;
            }
        }

        return $tipsToStore;
    }

    private function addToPackage($matchId, $tipType, $prediction, $confidenceLevel, $packageType)
    {
        if (!$packageType) {
            return;
        }

        Log::info("Adding Tip to Package | Match ID: $matchId | Package: $packageType | Tip Type: $tipType | Prediction: $prediction");

        $today = now()->toDateString();

        $packageRules = [
            'Full Time Scores Daily' => ['types' => ['1_X_2', '1X_X2_12'], 'limit' => 15],
            'Full Time Scores Weekly' => ['types' => ['1_X_2', '1X_X2_12'], 'limit' => 17],
            'Over/Under Market Daily' => ['types' => ['Over/Under'], 'limit' => 5],
            'Over/Under Market Weekly' => ['types' => ['Over/Under'], 'limit' => 7],
            'Sport Pesa Mega Jackpot' => ['types' => ['1_X_2', '1X_X2_12'], 'limit' => 17],
            'Sport Pesa Mid Week Jackpot' => ['types' => ['1_X_2', '1X_X2_12'], 'limit' => 13],
            'Mozzart Daily Jackpot' => ['types' => ['1_X_2', '1X_X2_12'], 'limit' => 16],
            'Mozzart Weekly Jackpot' => ['types' => ['1_X_2', '1X_X2_12'], 'limit' => 20],
            'Odi Bets Weekly Jackpot' => ['types' => ['1_X_2', '1X_X2_12'], 'limit' => 10]
        ];

        if (!isset($packageRules[$packageType]) || !in_array($tipType, $packageRules[$packageType]['types'], true)) {
            Log::warning("Package Type Not Found or Tip Type Not Allowed | Package: $packageType | Tip Type: $tipType");
            return;
        }

        $packageId = Packages::where('name', $packageType)->value('id');

        if (!$packageId) {
            Log::error("Package ID Not Found | Package: $packageType");
            return;
        }

        $selection = Selection::firstOrCreate(
            ['package_id' => $packageId, 'date_for' => $today],
            ['tips' => json_encode([])]
        );

        $tips = json_decode($selection->tips, true) ?? [];

        // Apply package limit
        $limit = $packageRules[$packageType]['limit'];
        if ($limit !== null && count($tips) >= $limit) {
            Log::info("Package Limit Reached | Package: $packageType | Limit: $limit | Match ID: $matchId");
            return;
        }

        $tips[] = [
            'match_id' => $matchId,
            'prediction_type' => $tipType,
            'prediction' => $prediction,
            'confidence' => $confidenceLevel
        ];

        if (in_array($packageType, [
            'Sport Pesa Mega Jackpot',
            'Sport Pesa Mid Week Jackpot',
            'Mozzart Daily Jackpot',
            'Mozzart Weekly Jackpot',
            'Odi Bets Weekly Jackpot'
        ])) {
            $selection->tips = json_encode([]);
            $selection->save();
        }

        $selection->update(['tips' => json_encode($tips)]);

        Log::info("Tip Successfully Added to Package | Package: $packageType | Match ID: $matchId");
    }

    private function processJackpotTip($matchId, $type, $tip, $confidenceLevel)
    {
        return $this->storeTip($matchId, $type, $tip, $confidenceLevel);
    }

    private function processFullTimeScoreTip($matchId, $type, $tip, $confidenceLevel)
    {
        return $this->storeTip($matchId, $type, $tip, $confidenceLevel);
    }

    private function processGGNGTip($matchId, $tip, $confidenceLevel)
    {
        return $this->storeTip($matchId, 'GG-NG', $tip, $confidenceLevel);
    }

    private function processOverUnderTip($matchId, $tip, $confidenceLevel)
    {
        $selectedPrediction = "Over 2.5";

        $validOverUnder = collect($tip)
            ->filter(fn($details, $threshold) => is_numeric($threshold) && isset($details['odds']) && $details['odds'] >= 1.4 && $details['odds'] <= 2.4)
            ->sortBy(fn($details, $threshold) => $threshold)
            ->keys()
            ->first();

        if ($validOverUnder) {
            $selectedPrediction = "Over " . $validOverUnder;
        }

        return $this->storeTip($matchId, "Over/Under", ['result' => $selectedPrediction], $confidenceLevel);
    }

    private function storeTip($matchId, $type, $tip, $confidenceLevel)
    {
        Tips::updateOrInsert(
            ['match_id' => $matchId, 'prediction_type' => $type],
            [
                'generated_by' => 1,
                'predictions' => $tip['result'],
                'prediction_confidence' => $confidenceLevel,
                'updated_at' => now()
            ]
        );

        return $tip['result'];
    }

    private function getJackpotPackage($jackpotTag)
    {
        $jackpotPackages = [
            'SPMJ' => 'Sport Pesa Mega Jackpot',
            'SPMWJ' => 'Sport Pesa Mid Week Jackpot',
            'MDJP' => 'Mozzart Daily Jackpot',
            'MWJP' => 'Mozzart Weekly Jackpot',
            'OBWJ' => 'Odi Bets Weekly Jackpot'
        ];

        return $jackpotTag ? ($jackpotPackages[$jackpotTag] ?? null) : null;
    }
}
