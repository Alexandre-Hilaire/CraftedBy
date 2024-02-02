<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_name' => "adresse_test",
            'address_type' => rand(0,1),
            'address_firstname' => fake()->firstName(),
            'address_lastname' => fake()->lastName(),
            'first_address' => fake() -> streetName(),
            'second_address' => fake() -> city(),
            'postal_code' => fake()-> postcode(),
        ];
    }
}
