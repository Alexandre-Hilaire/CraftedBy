<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Pmodel;
use App\Models\User;
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
        $pmodel = Pmodel::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        return [
            'unit_price'=>fake()->randomFloat($nbMaxDecimals = 3, $min=0, $max=100),
            'name'=>fake()->realText($maxNbChars = 50),
            'description'=>fake()->realText($maxNbChars = 255),
            'status'=>rand(0,2),
            'color'=>fake()->colorName(),
            'customizable'=>rand(0,1),
            'is_active'=>fake()->boolean(),
            'pmodel_id'=> $pmodel->id,
            'user_id'=> $user->id,
        ];
    }
}
