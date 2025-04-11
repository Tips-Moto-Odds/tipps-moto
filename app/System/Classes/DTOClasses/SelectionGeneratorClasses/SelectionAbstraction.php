<?php

    namespace App\System\Classes\DTOClasses\SelectionGeneratorClasses;

    use Carbon\Carbon;
    use JsonException;
    use App\Models\Matches;
    use App\Models\Packages;
    use App\Models\Selection;
    use InvalidArgumentException;
    use Illuminate\Support\Collection;

    abstract class SelectionAbstraction implements SelectionServiceInterface {
        protected Collection $matches;

        public function setMatches(Collection $matches): SelectionAbstraction
        {
            $this->matches = $matches;
            return $this;
        }

        protected function getPackageIDs(): array
        {
            return [
                'daily'  => Packages::where('name', $this->DAILYNAME)->firstOrFail(),
                'weekly' => Packages::where('name', $this->WEEKLYNAME)->firstOrFail()
            ];
        }

        protected function findOrMakeSelection(int $packageId, string $date): Selection
        {
            $selection = Selection::where('package_id', $packageId)
                                  ->where('status', 1)
                                  ->whereDate('date_for', $date)
                                  ->first();

            if ($selection) {
                return $selection;
            }

            return new Selection([
                                     'package_id' => $packageId,
                                     'status'     => 1,
                                     'date_for'   => $date,
                                 ]);
        }

        protected function getActiveSelections(): array
        {
            $packageIds = $this->getPackageIDs();
            $today = Carbon::today()->toDateString();

            return [
                'dailySelections'  => $this->findOrMakeSelection($packageIds['daily']->id, $today),
                'weeklySelections' => $this->findOrMakeSelection($packageIds['weekly']->id, $today),
            ];
        }

        /**
         * @throws JsonException
         */
        public function addMatches(): static
        {
            // get an active selection from the database set for the same date
            $selections = $this->getActiveSelections();

            foreach ($selections as $key => $selection) {
                $limit = match ($key) {
                    'dailySelections' => $this->DAILYLIMIT,
                    'weeklySelections' => $this->WEEKLYLIMIT,
                    default => throw new InvalidArgumentException("Unknown selection key: $key"),
                };

                $tips = [];
                $counter = 0;

                foreach ($this->matches as $match) {

                    $search_criteria = collect($match)
                        ->only(
                            'home_team',
                            'away_team',
                            'match_start_time',
                            'league'
                        );

                    $match_id = Matches::where(
                        [
                            'home_teams'       => $search_criteria['home_team'],
                            'away_teams'       => $search_criteria['away_team'],
                            'match_start_time' => $search_criteria['match_start_time'],
                            'league'           => $search_criteria['league'],
                        ]
                    )->firstOrFail()->id;

                    $tips[] = [
                        'match_id'        => $match_id,
                        'prediction_type' => $match['prediction_type'],
                        'prediction'      => $match['predictions'],
                        'confidence'      => $match['prediction_confidence'],
                    ];

                    $counter++;

                    if ($counter >= $limit) {
                        break;
                    }

                }

                $selection->tips = json_encode($tips, JSON_THROW_ON_ERROR);
                $selection->save();
            }
            return $this;
        }


    }
