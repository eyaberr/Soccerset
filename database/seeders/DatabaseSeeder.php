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
//        $this->call([
//            RoleSeeder::class,
//
//            ImageSeeder::class,
//            VideoSeeder::class
//        ]);
//        \App\Models\User::factory(10)->create();

        foreach (\App\Models\User::ROLES as $roleName => $value) {
            \App\Models\Role::factory()->create([
                'id' => $value,
                'name' => $roleName,
            ]);
        }

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'role_id' => \App\Models\User::ROLES["admin"]
        ]);
        $this->call([
            ChildSeeder::class,
            GroupSeeder::class,
            InfoSeeder::class,
            EventSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
