<?php

namespace Database\Seeders;

use App\Models\PumpMake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PumpMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PumpMake $pumpMake)
    {
        $pumpMake->insert([
            [
                'make' => 'Jun Jin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'make' => 'KCP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'make' => 'Putzmeister',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'make' => 'CPS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'make' => 'Callaghan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'make' => 'Concord',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
        
    }
}
