<?php

namespace Database\Factories;

use App\Models\User;
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
        $user = User::inRandomOrder()->first()->id;
        return [
            'user_id' => $user,
            'order_status'=>rand(0,7),
            'order_price'=>fake()->randomFloat(2,0,1000),
            'order_date'=>fake()-> dateTime(),
            'delivery_adress'=> fake()->streetAddress(),
            'facturation_adress'=>fake()->streetAddress(),
        ];
    }
}
