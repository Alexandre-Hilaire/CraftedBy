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
            'id'=>fake()->uuid(),
            'order_status'=>rand(0,7),
            'order_price'=>fake()->random_float(),
            'order_date'=>fake()-> dateTime(),
            'delivery_adress'=> fake()->city(),
            'facturation_adress'=>fake()->city(),
        ];
    }
}
