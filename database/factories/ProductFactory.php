<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
            'thumbnail' => $this->faker->file(
                base_path('/tests/Fixtures/images/products'),
                storage_path('/app/public/images/products'),
                false
            ),
            'price' => $this->faker->numberBetween(10000, 100000),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        ];
    }
}
