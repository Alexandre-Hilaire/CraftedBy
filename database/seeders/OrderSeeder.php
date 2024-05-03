<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(10)
        ->create()
        ->each(function(Order $order){
            $products = Product::inRandomOrder()->limit(rand(1,5))->get();
            foreach($products as $product){
                $quantity = rand(1,5);
                $name = $product -> name;
                $unit_price = $product -> unit_price;
                $order -> products()->attach($product, ['product_name'=>$name, 'quantity'=>$quantity, 'unit_price'=>$unit_price]);       
            }
        });
    }
}
