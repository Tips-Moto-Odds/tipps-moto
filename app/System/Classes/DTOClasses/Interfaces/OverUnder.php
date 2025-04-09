<?php

namespace App\System\Classes\DTOClasses\Interfaces;

use App\System\Classes\DTOClasses\Enums\TipType;
use App\System\Classes\DTOClasses\SelectionGeneratorClasses\SelectionAbstraction;

interface OverUnder
{
    const TipType tipType = TipType::OVER_UNDER;

    const int DAILYLIMIT = 5;
    const int WEEKLYLIMIT = 7;
}
