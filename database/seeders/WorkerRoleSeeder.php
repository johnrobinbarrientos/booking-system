<?php

namespace Database\Seeders;

use App\Models\WorkerRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(WorkerRole $workerRole)
    {
        $workerRole->insert([
            [
                'role_name' => 'Operator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name' => 'Hoseman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name' => 'Extraman',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
