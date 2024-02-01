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
            'id'=>fake()->uuid(),
            'unit_price'=> fake()-> random_float(),
            'name'=>fake()->realText($maxNbChars = 50),
            'description'=>fake()->realText($maxNbChars = 500),
            'status'=>rand(0,2),
            'color'=>fake()->colorName(),
            'customizable'=>random_int(0,1),
            'is_active'=>fake()->boolean()
        ];
    }
}
