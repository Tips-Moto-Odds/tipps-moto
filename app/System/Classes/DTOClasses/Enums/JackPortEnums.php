<?php

    namespace App\System\Classes\DTOClasses\Enums;

    use App\System\Classes\DTOClasses\JackpotsSelections\Jackpot;

    enum JackPortEnums: string {
        case SPORT_PESA_MID_WEEK_JACKPOT = 'SPMWJ';
        case SPORT_PESA_MEGA_JACKPOT = 'SPMJ';
        case MOZZART_WEEKLY_JACKPOT = 'MWJP';
        case MOZZART_DAILY_JACKPOT = 'MDJP';
        case ODIBETS_WEEKLY_JACKPOT = 'OBWJ';

        public function parserClass(): string
        {
            return Jackpot::class;
        }
    }




