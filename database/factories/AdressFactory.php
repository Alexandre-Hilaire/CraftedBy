<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'adress_name' => "adresse_test",
            'adress_type' => rand(0,1),
            'adress_firstname' => fake()->firstName(),
            'adress_lastname' => fake()->lastName(),
            'first_adress' => fake() -> streetName(),
            'second_adress' => fake() -> city(),
            'postal_code' => fake()-> postcode(),
        ];
    }
}
