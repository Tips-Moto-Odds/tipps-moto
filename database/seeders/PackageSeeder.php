<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Packages;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            ['name' => 'Full Time Scores Daily', 'tips' => 15, 'period' => 1, 'price' => 99, 'description' => 'match'],
            ['name' => 'Full Time Scores Weekly', 'tips' => 17, 'period' => 1, 'price' => 599, 'description' => 'match'],
            ['name' => 'OVer/Under Market Daily', 'tips' => 5, 'period' => 1, 'price' => 29, 'description' => 'over-under'],
            ['name' => 'OVer/Under Market Weekly', 'tips' => 7, 'period' => 1, 'price' => 199, 'description' => 'over-under'],
            ['name' => 'Sport Pesa Maega Jackpot', 'tips' => 17, 'period' => 1, 'price' => 49, 'description' => 'jackpot'],
            ['name' => 'Sport Pesa Mid Week Jackpot', 'tips' => 15, 'period' => 1, 'price' => 39, 'description' => 'jackpot'],
            ['name' => 'Mozzart daily jackpot', 'tips' => 20, 'period' => 1, 'price' => 29, 'description' => 'jackpot'],
            ['name' => 'Mozzart weekly jackpot', 'tips' => 16, 'period' => 1, 'price' => 49, 'description' => 'jackpot'],
            ['name' => 'Odi bets weekly jackpot', 'tips' => 10, 'period' => 1, 'price' => 29, 'description' => 'jackpot'],
        ];

        foreach ($packages as $package) {
            $exist = Packages::where('name', $package['name'])->exists();

            if (!$exist) {
                $package['currency'] = 'ksh';
                Packages::create($package);
            }
        }
    }
}
