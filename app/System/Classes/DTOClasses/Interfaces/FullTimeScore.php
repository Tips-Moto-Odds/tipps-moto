<?php

namespace App\System\Classes\DTOClasses\Interfaces;

use App\System\Classes\DTOClasses\Enums\TipType;

interface FullTimeScore
{
    const TipType tipType = TipType::FULL_TIME;

    const int DAILYLIMIT = 15;
    const int WEEKLYLIMIT = 17;
}
