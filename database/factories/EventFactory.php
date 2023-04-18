<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user=User::latest()->first() ;
        return [
            'title'=>fake()->title(),
            'description'=>fake()->paragraph(),
            'type'=>fake()->name(),
            'user_id'=>$user->id,
            'start_date'=>fake()->date(),
            'end_date'=>fake()->date(),
        ];
    }
}
