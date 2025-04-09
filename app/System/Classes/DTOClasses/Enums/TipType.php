<?php

namespace App\System\Classes\DTOClasses\Enums;

use App\System\Classes\DTOClasses\ExtractorClasses\DoubleChance;
use App\System\Classes\DTOClasses\ExtractorClasses\FullTimeScore;
use App\System\Classes\DTOClasses\ExtractorClasses\GoalNoGoal;
use App\System\Classes\DTOClasses\ExtractorClasses\OverUnder;

enum TipType :string
{
    case DOUBLE_CHANCE = '1X_X2_12';
    case FULL_TIME     = '1_X_2';
    case GOAL_NO_GOAL   = 'GG_NG';
    case OVER_UNDER    = 'Over/Under';

    public function parserClass(): string
    {
        return match($this) {
            self::DOUBLE_CHANCE => DoubleChance::class,
            self::FULL_TIME     => FullTimeScore::class,
            self::GOAL_NO_GOAL   => GoalNoGoal::class,
            self::OVER_UNDER    => OverUnder::class,
        };
    }
}



