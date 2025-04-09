<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Tips;
use App\Modules\SelectionModule;
use App\Modules\TipModule;
use App\System\Classes\DTOClasses\Enums\JackpotsEnums;
use App\System\Classes\DTOClasses\Enums\TipType;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use RuntimeException;
use Throwable;


class AutomationController extends Controller
{
    private bool $commitToJsonFile = false;
    private bool $commitToDatabase = true;
    private bool $commitSelections = true;

    public function __construct(
        protected TipModule       $tipModule,
        protected SelectionModule $selectionModules
    )
    {
    }

    public function __invoke(Request $request): array
    {
        $parseMatchesData = $this->parseMatches($request);

        if ($this->commitToJsonFile) {
            $this->commit_to_json($parseMatchesData);
        }

        if ($this->commitToDatabase) {
            $this->commit_to_database($parseMatchesData);
        }

        if ($this->commitSelections) {
            $this->prepareSelections($parseMatchesData);
        }

        return $parseMatchesData;
    }

    public function prepareSelections(array $parseMatchesData):bool
    {
        $collectedMatchesData = collect($parseMatchesData)->groupBy('prediction_type');

        foreach ($collectedMatchesData as $type => $matches) {
            $parser = TipType::tryFrom($type)?->parserClass()
                ?? throw new InvalidArgumentException("Unknown tip type: $type");

            $parserInstance = (new $parser(null,''));

            try {
                $parserInstance
                    ->selectionAbstraction
                    ->setMatches(collect($matches))
                    ->addMatches();

            }catch (Exception $exception){
                logger($exception->getMessage());
                return false;
            }
        }

        return true;
    }


    public function commit_to_json($matchData): bool
    {
        try {
            // Create timestamped filename
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = "{$timestamp}_match_data.json";

            Storage::disk('tipsStorage')
                ->put($filename, json_encode($matchData,
                    JSON_THROW_ON_ERROR |
                    JSON_PRETTY_PRINT
                ));

            return true;
        } catch (Throwable $e) {
            Log::error("Failed to commit matches to JSON: " . $e->getMessage());
            return false;
        }
    }

    public function parseMatches(Request $request): array
    {
        $matchesData = [];

        foreach ($request->all() as $riskLevel => $matches) {
            foreach ($matches as $match) {
                if (empty($match['tips'])) {
                    throw new RuntimeException('Some Matches do not have any tips available');
                }

                foreach ($match['tips'] as $tipType => $tip) {
                    try {
                        $parser = TipType::tryFrom($tipType)?->parserClass()
                            ?? throw new InvalidArgumentException("Unknown tip type: $tipType");

                        $parsedTip = (new $parser($tip, $riskLevel))->parse();

                        $matchesData[] = array_merge([
                            'home_team' => $match['Home Team'],
                            'away_team' => $match['Away Team'],
                            'match_start_time' => $match['date'],
                            'league' => $match['league'],
                            'is_jackpot' => in_array($match['Jackpot'] ?? null, array_column(JackpotsEnums::cases(), 'name'), true),
                        ], $parsedTip);

                    } catch (Throwable $e) {
                        logger($e->getMessage());
                        continue;
                    }
                }
            }
        }

        return $matchesData;
    }

    private function commit_to_database($parseMatchesData): void
    {
        foreach ($parseMatchesData as $matchData) {
            $match = Matches::updateOrCreate(
                [
                    'league' => $matchData['league'],
                    'home_teams' => $matchData['home_team'],
                    'away_teams' => $matchData['away_team'],
                    'match_start_time' => $matchData['match_start_time'],
                ],
                [
                    'status' => 'pending',
                ]
            );

            $tip = $match->wasRecentlyCreated
                ? new Tips()
                : Tips::firstOrNew(
                    [
                        'match_id' => $match->id,
                        'prediction_type' => $matchData['prediction_type'],
                    ]
                );

            $tip->fill([
                'match_id' => $match->id,
                'generated_by' => 1,
                'prediction_type' => $matchData['prediction_type'],
                'predictions' => $matchData['predictions'],
                'prediction_confidence' => $matchData['prediction_confidence'],
            ]);

            $tip->save();

        }
    }
}
