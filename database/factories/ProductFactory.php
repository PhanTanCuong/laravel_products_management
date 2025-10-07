<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ProductCategory;

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

    protected $model = \App\Models\Product::class;

    public function definition(): array
    {
        return [
            'product_id' => $this->faker->unique()->randomNumber(),
            'product_name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'product_category_id' => ProductCategory::inRandomOrder()->value('id') ?? 1,
            'created_at' => now(),
        ];
    }
}
