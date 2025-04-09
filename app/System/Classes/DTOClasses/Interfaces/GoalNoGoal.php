<?php

namespace App\System\Classes\DTOClasses\Interfaces;

use App\System\Classes\DTOClasses\Enums\TipType;

interface GoalNoGoal
{
    const TipType tipType = TipType::GOAL_NO_GOAL;

    const int DAILYLIMIT = 5;
    const int WEEKLYLIMIT = 7;
}

