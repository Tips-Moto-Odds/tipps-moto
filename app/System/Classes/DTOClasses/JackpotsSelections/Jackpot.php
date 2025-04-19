<?php

    namespace App\System\Classes\DTOClasses\JackpotsSelections;


    use Carbon\Carbon;
    use App\Models\Matches;
    use App\Models\Packages;
    use App\Models\Selection;
    use App\System\Classes\DTOClasses\SelectionGeneratorClasses\SelectionAbstraction;

    class Jackpot extends SelectionAbstraction {

        public string $SPORTPESAMIDWEEKJACKPOT = 'Sport Pesa Mid Week Jackpot';
        public string $SPORTPESAMEGAJACKPOT = 'Sport Pesa Mega Jackpot';
        public string $MOZZARDDAILYJACKPOT = 'Mozzart daily jackpot';
        public string $MOZZARTWEEKLYJACKPOT = 'Mozzart weekly jackpot';
        public string $ODIBETSWEEKLYJACKPOT = 'Odi bets weekly jackpot';


        protected function getPackageID(): int
        {
            $type = $this->matches[0]['jackpot'];

            $package = match ($type) {
                'SPMWJ' => Packages::where('name', $this->SPORTPESAMIDWEEKJACKPOT)->firstOrFail(),
                'SPMJ' => Packages::where('name', $this->SPORTPESAMEGAJACKPOT)->firstOrFail(),
                'MWJP' => Packages::where('name', $this->MOZZARTWEEKLYJACKPOT)->firstOrFail(),
                'MDJP' => Packages::where('name', $this->MOZZARDDAILYJACKPOT)->firstOrFail(),
                'OBWJ' => Packages::where('name', $this->ODIBETSWEEKLYJACKPOT)->firstOrFail(),
            };

            return (int)$package->id;
        }

        protected function getActiveSelection(): Selection
        {
            $packageId = $this->getPackageID();
            $today = Carbon::today()->toDateString();

            return $this->findOrMakeSelection($packageId, $today);
        }

        public function addMatches(): static
        {

            $selection = $this->getActiveSelection();

            $tips = [];

            $tips = $this->getArr($tips);

            $selection->tips = json_encode($tips, JSON_THROW_ON_ERROR);

            $test = $selection->save();

            return $this;
        }

        /**
         * @param array $tips
         * @return array
         */
        public function getArr(array $tips): array
        {
            foreach ($this->matches as $match) {

                $search_criteria = collect($match)->only(
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
            }
            return $tips;
        }


    }
