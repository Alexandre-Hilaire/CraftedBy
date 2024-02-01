<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_status'=>rand(0,7),
            'order_price'=>fake()->randomFloat(),
            'order_date'=>fake()-> dateTime(),
            'delivery_adress'=> fake()->streetAddress(),
            'facturation_adress'=>fake()->streetAddress(),
        ];
    }
}
