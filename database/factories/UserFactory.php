<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "email" => $this->faker->unique()->safeEmail,
            "password" => Hash::make('12345678'),
            "card_id" => $this->faker->unique()->numberBetween(1000000, 30000000),
            "phone" => $this->faker->phoneNumber,
            "cell_phone" => $this->faker->phoneNumber,
            "address" => $this->faker->address,
            "municipality_id" => $this->faker->numberBetween(1, 28),
            "is_underage" => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
