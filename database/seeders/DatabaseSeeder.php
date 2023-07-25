<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\Subbie;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        //$this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PumpCategorySeeder::class);
        $this->call(ConcreteSupplierSeeder::class);
        $this->call(ConcreteTypeSeeder::class);
        $this->call(WorkerRoleSeeder::class);
        $this->call(PumpMakeSeeder::class);
        //fake clients 
        Client::factory()->times(100)->create();
        Project::factory()->times(100)->create();
        Subbie::factory()->times(100)->create();
        //Worker::factory()->times(100)->create();
    }
}
