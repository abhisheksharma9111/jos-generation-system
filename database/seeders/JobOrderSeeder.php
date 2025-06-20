<?php

namespace Database\Seeders;

use App\Models\JobOrder;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobOrderSeeder extends Seeder
{
    public function run()
    {
        $jobOrders = [
            [
                'name' => 'Main Building Wiring',
                'date' => Carbon::today()->subDays(15),
                'jos_date' => Carbon::today()->subDays(15),
                'type_of_work_id' => 1,
                'contractor_id' => 1,
                'conductor_id' => 1,
                'actual_work_completed' => 120,
                'remarks' => 'Completed phase 1 wiring'
            ],
            [
                'name' => 'Office Plumbing',
                'date' => Carbon::today()->subDays(10),
                'jos_date' => Carbon::today()->subDays(10),
                'type_of_work_id' => 2,
                'contractor_id' => 3,
                'conductor_id' => 3,
                'actual_work_completed' => 85,
                'remarks' => 'Installed all fixtures'
            ],
            [
                'name' => 'Lobby Painting',
                'date' => Carbon::today()->subDays(5),
                'jos_date' => Carbon::today()->subDays(5),
                'type_of_work_id' => 5,
                'contractor_id' => 1,
                'conductor_id' => 1,
                'actual_work_completed' => 200,
                'remarks' => 'Two coats applied'
            ],
            [
                'name' => 'Electrical Panel Upgrade',
                'date' => Carbon::today()->subDays(3),
                'jos_date' => Carbon::today()->subDays(3),
                'type_of_work_id' => 1,
                'contractor_id' => 2,
                'conductor_id' => 2,
                'actual_work_completed' => 65,
                'remarks' => '100A to 200A upgrade'
            ],
        ];

        foreach ($jobOrders as $jobOrder) {
            JobOrder::create($jobOrder);
        }
    }
}