<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockMovementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['IN', 'OUT']),
            'quantity' => $this->faker->numberBetween(1, 50),
            'notes' => $this->faker->sentence(),
        ];
    }
}
