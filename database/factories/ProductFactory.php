<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 10000, 500000),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
