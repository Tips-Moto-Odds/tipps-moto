<?php

    namespace App\System\Classes\DTOClasses\SelectionGeneratorClasses;


    use App\System\Classes\DTOClasses\Interfaces\DoubleChance as DoubleChanceAlias;

    class DoubleChance extends SelectionAbstraction implements DoubleChanceAlias {

        public string $DAILYNAME = 'Double Chances Daily';
        public string $WEEKLYNAME = 'Double Chances Weekly';

        public int $DAILYLIMIT = 15;
        public int $WEEKLYLIMIT = 17;

    }
