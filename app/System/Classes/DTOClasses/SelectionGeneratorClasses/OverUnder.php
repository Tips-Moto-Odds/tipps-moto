<?php

namespace App\System\Classes\DTOClasses\SelectionGeneratorClasses;

use App\System\Classes\DTOClasses\Enums\TipType;
use App\System\Classes\DTOClasses\Interfaces\OverUnder as OverUnderAlias;

class OverUnder extends SelectionAbstraction implements OverUnderAlias
{
    public string $DAILYNAME = 'Over/Under Market Daily';
    public string $WEEKLYNAME = 'Over/Under Market Weekly';

    public int $DAILYLIMIT = 5;
    public int $WEEKLYLIMIT = 7;
}
