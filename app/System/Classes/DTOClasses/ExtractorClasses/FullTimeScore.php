<?php

namespace App\System\Classes\DTOClasses\ExtractorClasses;

use App\System\Classes\DTOClasses\Interfaces\FullTimeScore as FullTimeScoreAlias;

class FullTimeScore extends TipsParser implements FullTimeScoreAlias
{
    private array $setup = ['1' => 1, 'X' => 0, '2' => -1];


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
            '0' => $this->rawTips['odds'][1],
            '-1' => $this->rawTips['odds'][2],
        };
    }
}
