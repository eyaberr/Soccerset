<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        /**
         * Seed the application's database.
         */
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            ChildSeeder::class,
            GroupSeeder::class,
            InfoSeeder::class,
            EventSeeder::class,
            ImageSeeder::class,
            VideoSeeder::class,

        ]);
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
