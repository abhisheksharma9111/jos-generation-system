<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TypeOfWorkSeeder::class,
            ContractorSeeder::class,
            ConductorSeeder::class,
            JobOrderSeeder::class,
        ]);
    }
}