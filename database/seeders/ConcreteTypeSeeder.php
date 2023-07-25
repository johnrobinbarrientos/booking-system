<?php

namespace Database\Seeders;

use App\Models\ConcreteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcreteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConcreteType $concreteType)
    {
        $concreteType->insert([
            [
                'concrete_type' => 'Normal strength concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_type' => 'Plain concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_type' => 'Lightweight concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_type' => 'Ready mix concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_type' => 'Polymer concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_type' => 'Glass concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_type' => 'Reinforced concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_type' => 'Pervious concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
