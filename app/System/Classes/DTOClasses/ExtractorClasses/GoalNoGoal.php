<?php

namespace App\System\Classes\DTOClasses\ExtractorClasses;

use App\System\Classes\DTOClasses\Interfaces\GoalNoGoal as GoalNoGoalAlias;

class GoalNoGoal extends TipsParser implements GoalNoGoalAlias
{
    private array $setup =  ['GG' => 1, 'NG' => -1];


    public function __construct(
        $rawTips,
        public string $predictionConfidence
    )
    {
        parent::__construct($rawTips);
    }

    protected function oddsParser(): float
    {
        return match ((string) $this->parsePredictions()) {
            '1' => $this->rawTips['odds'][0],
            '-1' => $this->rawTips['odds'][1],
        };
    }
}

