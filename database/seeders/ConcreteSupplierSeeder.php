<?php

namespace Database\Seeders;

use App\Models\ConcreteSupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcreteSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConcreteSupplier $concreteSupplier)
    {
        $concreteSupplier->insert([
            [
                'concrete_supplier' => 'bgc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'boral',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'hanson',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'holcim',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'limecret',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'mcs',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'mundaring concrete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'tdc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'concrete_supplier' => 'wa premix',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
