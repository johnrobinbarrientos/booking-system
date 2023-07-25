<?php

namespace Database\Seeders;

use App\Models\PumpCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PumpCategorySeeder extends Seeder
{
    /**
     * @param PumpCategory $pumpCategory
     */
    public function run(PumpCategory $pumpCategory)
    {
        $pumpCategory->insert([
            [
                'category_name' => 'Boom Pump',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Line Pump',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
