<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SkillSeeder::class,
            PortfolioSeeder::class,
            CertificationSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
