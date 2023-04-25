<?php

namespace Database\Seeders;

use App\Models\EventSubscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventSubscription::factory()->count(5)->create();
    }
}
