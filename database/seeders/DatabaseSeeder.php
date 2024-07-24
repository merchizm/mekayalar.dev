<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
<<<<<<< HEAD
=======

        $this->call(AdminSeeder::class);
>>>>>>> ea77053 (md editor integrated)
        $this->call(PoemSeeder::class);
    }
}
