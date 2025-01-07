<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->name,
            'category_id' => rand(1, 10), // assuming you have categories with ids from 1 to 10
            'supplier_id' => rand(1, 10), // assuming you have suppliers with ids from 1 to 10
            'product_code' => 'PC' . rand(1000, 9999),
            'product_garage' => $this->faker->word,
            'product_store' => rand(1, 100),
            'buying_date' => $this->faker->date,
            'expire_date' => $this->faker->date,
            'buying_price' => rand(100, 1000),
            'selling_price' => rand(100, 1000),
        ];
    }
}
