<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first(); // Retrieve a random user
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'user_id'=> $user->id, // Retrieve the ID of the associated user
            'age'=> fake()->numberBetween(int1: 3 ,int2: 14),
        ];
    }
}
