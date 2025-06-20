<?php

namespace Database\Seeders;

use App\Models\TypeOfWork;
use Illuminate\Database\Seeder;

class TypeOfWorkSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['name' => 'Electrical Installation', 'code' => 'ELEC-INST', 'rate' => 45.50],
            ['name' => 'Plumbing Work', 'code' => 'PLUMB-WRK', 'rate' => 38.75],
            ['name' => 'Carpentry', 'code' => 'CARPENTRY', 'rate' => 42.00],
            ['name' => 'Concrete Pouring', 'code' => 'CONCRETE', 'rate' => 55.25],
            ['name' => 'Painting', 'code' => 'PAINTING', 'rate' => 32.80],
        ];

        foreach ($types as $type) {
            TypeOfWork::create($type);
        }
    }
}