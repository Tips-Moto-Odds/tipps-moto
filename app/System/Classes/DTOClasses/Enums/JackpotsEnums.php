<?php

namespace App\System\Classes\DTOClasses\Enums;

enum JackpotsEnums: string
{
    case SPMJ  = 'Sport Pesa Mega Jackpot';
    case SPMWJ = 'Sport Pesa Mid Week Jackpot';
    case MDJP  = 'Mozzart Daily Jackpot';
    case MWJP  = 'Mozzart Weekly Jackpot';
    case OBWJ  = 'Odi Bets Weekly Jackpot';

    public static function labels(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public static function fromLabel(string $label): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $label) {
                return $case;
            }
        }
        return null;
    }
}
