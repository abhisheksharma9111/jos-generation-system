<?php

namespace Database\Seeders;

use App\Models\Contractor;
use Illuminate\Database\Seeder;

class ContractorSeeder extends Seeder
{
    public function run()
    {
        $contractors = [
            [
                'name' => 'John Smith',
                'company_name' => 'Smith Construction Ltd',
                'email' => 'john@smithconstruction.com',
                'phone_number' => '5550102030',
                'code' => 'CTR-001',
                'balance' => 12500.00
            ],
            [
                'name' => 'Maria Garcia',
                'company_name' => 'Garcia Electrical Works',
                'email' => 'maria@garciaelectrical.com',
                'phone_number' => '5550203040',
                'code' => 'CTR-002',
                'balance' => 8500.00
            ],
            [
                'name' => 'David Johnson',
                'company_name' => 'Johnson Plumbing Services',
                'email' => 'david@johnsonplumbing.com',
                'phone_number' => '5550304050',
                'code' => 'CTR-003',
                'balance' => 0.00
            ],
        ];

        foreach ($contractors as $contractor) {
            Contractor::create($contractor);
        }
    }
}