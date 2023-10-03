<?php

namespace Database\Factories;

use App\Models\Category;
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
            //
            'title' =>$this->faker->unique()->jobTitle(),
            'description' =>$this->faker->text(190),
            'price' =>$this->faker->randomNumber(5, false),
            'quantity' =>$this->faker->numberBetween(1,80),
            'category_id' =>Category::all()->random()->id
        ];
    }
}
