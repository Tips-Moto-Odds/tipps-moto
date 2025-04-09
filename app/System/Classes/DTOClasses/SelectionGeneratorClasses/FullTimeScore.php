<?php

namespace App\System\Classes\DTOClasses\SelectionGeneratorClasses;


use App\System\Classes\DTOClasses\Interfaces\FullTimeScore as FullTimeScoreAlias;

class FullTimeScore extends SelectionAbstraction implements FullTimeScoreAlias
{

    public string $DAILYNAME = 'Full Time Scores Daily';
    public string $WEEKLYNAME = 'Full Time Scores Weekly';

    public int $DAILYLIMIT = 15;
    public int $WEEKLYLIMIT = 17;

}
