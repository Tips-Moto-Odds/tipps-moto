<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\MatchModule;
use App\Modules\TipModule;
use App\Modules\SelectionModule;
use Illuminate\Support\Facades\Log;

class AutomationController extends Controller
{
    public function __construct(
        protected MatchModule $matchModule,
        protected TipModule $tipModule,
        protected SelectionModule $selectionModules
    ) {}

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->getAutomation($request);
    }

    public function getAutomation(Request $request): \Illuminate\Http\JsonResponse
    {
        $payload = $request->all();

        foreach ($payload as $key => $matchData) {
            foreach ($matchData as $matchIndex => $value) {
                $jackpotTag = null;
                $match = $this->matchModule->findOrCreateMatch($value);

                $isJackpot = !empty($value['jackpot']);

                if ($isJackpot) {
                    $jackpotTag = $value['jackpot'];
                }

                $tipsToStore = $this->tipModule->processTips($match->id, $value['tips'], $key, $isJackpot,$jackpotTag);

                Log::info("done with a match");
            }
        }

        return response()->json(['message' => 'Matches processed successfully']);
    }
}
