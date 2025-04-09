<?php

namespace App\System\Classes\DTOClasses\ExtractorClasses;

use App\System\Classes\DTOClasses\Interfaces\DoubleChance as DoubleChanceAlias;

class DoubleChance extends TipsParser implements DoubleChanceAlias
{
    private array $setup = ['1X' => 1, 'X2' => 0, '12' => -1];

    public function __construct($rawTips = null, public ?string $predictionConfidence = '')
    {
        parent::__construct($rawTips);
    }


    protected function oddsParser(): float
    {
        return match ((string)$this->parsePredictions()) {
            '1' => $this->rawTips['odds'][0],
            '0' => $this->rawTips['odds'][1],
            '-1' => $this->rawTips['odds'][2],
        };
    }


    public function generateSelections($matches): string
    {
        //TODO::check this and reference
        return '';
    }

}
