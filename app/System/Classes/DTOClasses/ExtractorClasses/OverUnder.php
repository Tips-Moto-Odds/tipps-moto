<?php

namespace App\System\Classes\DTOClasses\ExtractorClasses;

use Exception;
use RuntimeException;
use InvalidArgumentException;
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
     * @throws Exception
     */
    protected function parsePredictions(): string|int
    {
        $oddData = $this->rawTips[1]['result'] ?? null;

        if ($oddData === null) {
            throw new RuntimeException('Over and under 2.5 cannot be null');
        }

        return $oddData;
    }

    /**
     * @throws Exception
     */
    /**
     * Pick the correct odds for the current O/U prediction.
     *
     * Example rawTips structure
     * ├─ rawTips[0]['2.5']['odds'] = ['1.90', '1.88']   // [over‑odds, under‑odds]
     * └─ rawTips[1]['result']      = 'Under 2.5'
     */
    protected function oddsParser(): float
    {
        // e.g. "Under 2.5"
        $tipString = $this->rawTips[1]['result'] ?? null;

        if (!$tipString) {
            throw new RuntimeException('rawTips[1][result] is missing');
        }

        /** --------------------------------------------------------------
         * 1. Split into direction ("over|under") and line ("2.5", "3.25")
         * -------------------------------------------------------------- */
        [$direction, $line] = array_values(
            array_map('trim', preg_split('/\s+/', strtolower($tipString), 2))
        );

        if (!in_array($direction, ['over', 'under'], true)) {
            throw new InvalidArgumentException("Unknown direction “{$direction}”");
        }

        /** --------------------------------------------------------------
         * 2. Locate that goal‑line in the odds table
         * -------------------------------------------------------------- */
        if (!isset($this->rawTips[0][$line]['odds'])) {
            throw new InvalidArgumentException("No odds found for line “{$line}”");
        }

        $oddsPair = $this->rawTips[0][$line]['odds'];        // [over, under]

        /** --------------------------------------------------------------
         * 3. Pick column: index 0 = over, index 1 = under
         * -------------------------------------------------------------- */
        $index = $direction === 'over' ? 0 : 1;

        return (float)$oddsPair[$index];
    }

}
