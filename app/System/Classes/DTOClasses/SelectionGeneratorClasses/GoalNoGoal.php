<?php

namespace App\System\Classes\DTOClasses\SelectionGeneratorClasses;

use App\System\Classes\DTOClasses\Interfaces\GoalNoGoal as GoalNoGoalAlias;

class GoalNoGoal extends SelectionAbstraction implements GoalNoGoalAlias
{

    public string $DAILYNAME = 'Goal-No Goal Daily';
    public string $WEEKLYNAME = 'Goal-No Goal Weekly';

    public int $DAILYLIMIT = 5;
    public int $WEEKLYLIMIT = 7;
}

