<?php

namespace Database\Seeders;

use App\Models\Conductor;
use Illuminate\Database\Seeder;

class ConductorSeeder extends Seeder
{
    public function run()
    {
        $conductors = [
            [
                'first_name' => 'Robert',
                'last_name' => 'Williams',
                'staff_id' => 'EMP-001',
                'department_name' => 'Construction',
                'email' => 'robert.williams@company.com',
                'phone_number' => '5551112222'
            ],
            [
                'first_name' => 'Jennifer',
                'middle_name' => 'Anne',
                'last_name' => 'Brown',
                'staff_id' => 'EMP-002',
                'department_name' => 'Electrical',
                'email' => 'jennifer.brown@company.com',
                'phone_number' => '5552223333'
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Davis',
                'staff_id' => 'EMP-003',
                'department_name' => 'Plumbing',
                'email' => 'michael.davis@company.com',
                'phone_number' => '5553334444'
            ],
        ];

        foreach ($conductors as $conductor) {
            Conductor::create($conductor);
        }
    }
}