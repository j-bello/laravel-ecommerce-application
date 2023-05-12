<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number' => $this->faker->unique()->randomNumber(7),
        'user_id' => $this->faker->numberBetween(1, 10),
        'status' => $this->faker->randomElement(['pending', 'processing', 'completed']),
        'grand_total' => $this->faker->randomFloat(2, 10, 500),
        'item_count' => $this->faker->numberBetween(1, 10),
        'payment_status' => $this->faker->boolean,
        'payment_method' => $this->faker->word,
        'first_name' => $this->faker->firstName,
        'last_name' => $this->faker->lastName,
        'address' => $this->faker->streetAddress,
        'city' => $this->faker->city,
        'country' => $this->faker->country,
        'post_code' => $this->faker->postcode,
        'phone_number' => $this->faker->phoneNumber,
        'notes' => $this->faker->sentence,
        ];
    }
}
