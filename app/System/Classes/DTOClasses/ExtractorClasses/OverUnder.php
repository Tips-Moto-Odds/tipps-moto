<?php

namespace App\System\Classes\DTOClasses\ExtractorClasses;

use App\System\Classes\DTOClasses\Interfaces\OverUnder as OverUnderAlias;

class OverUnder extends TipsParser implements OverUnderAlias
{
    private array $setup = ['over' => 1, 'under' => -1];

    public function __construct(
        $rawTips,
        public string $predictionConfidence
    )
    {
        parent::__construct($rawTips);
    }

    /**
     * @throws \Exception
     */
    protected function parsePredictions(): string|int
    {
        $oddData = $this->rawTips[0]['2.5'] ?? null;

        if ($oddData === null) {
            throw new \RuntimeException('Over and under 2.5 cannot be null');
        }

        return $oddData['result'];
    }

    /**
     * @throws \Exception
     */
    protected function oddsParser(): float
    {
        $rawTipOverride = $this->rawTips[0]['2.5'];
        return match ((string)$this->parsePredictions()) {
            '1' => $rawTipOverride['odds'][0],
            '-1' => $rawTipOverride['odds'][1],
        };
    }
}
