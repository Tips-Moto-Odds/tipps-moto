<?php

    namespace App\System\Classes\DTOClasses\ExtractorClasses;

    use RuntimeException;
    use App\System\Classes\DTOClasses\SelectionGeneratorClasses\SelectionAbstraction;
    use App\System\Classes\DTOClasses\SelectionGeneratorClasses\OverUnder as OverUnderAlias;
    use App\System\Classes\DTOClasses\SelectionGeneratorClasses\GoalNoGoal as GoalNoGoalAlias;
    use App\System\Classes\DTOClasses\SelectionGeneratorClasses\DoubleChance as DoubleChanceAlias;
    use App\System\Classes\DTOClasses\SelectionGeneratorClasses\FullTimeScore as FullTimeScoreAlias;

    abstract class TipsParser {
        public SelectionAbstraction $selectionAbstraction;

        protected static array $SelectionAbstractionMap = [
            DoubleChance::class  => DoubleChanceAlias::class,
            FullTimeScore::class => FullTimeScoreAlias::class,
            GoalNoGoal::class    => GoalNoGoalAlias::class,
            OverUnder::class     => OverUnderAlias::class,
        ];

        public function __construct(
            public ?array $rawTips = null,
        ) {
            $this->selectionAbstraction = $this->instantiateSelection();
        }

        public function parse(): array
        {
            return [
                'prediction_type'       => static::tipType->value,
                'prediction_confidence' => $this->predictionConfidence,
                'predictions'           => $this->parsePredictions(),
                'predictionOdd'         => $this->oddsParser()
            ];
        }

        protected function parsePredictions(): string|int
        {
            return $this->rawTips['result'];
        }

        abstract protected function oddsParser(): float;

        private function instantiateSelection(): SelectionAbstraction
        {
            $calledClass = static::class;

            $map = static::$SelectionAbstractionMap;

            if (!array_key_exists($calledClass, $map)) {
                throw new RuntimeException("No selection abstraction defined for {$calledClass}");
            }

            $selectionClass = $map[$calledClass];

            return new $selectionClass();
        }
    }
