<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Crafter;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user){
        
            $user->adresses()->saveMany(Address::factory(2)->create());

            $user->crafter()->save(Crafter::factory()->create());

            $user->products()->saveMany(Product::factory(2)->create());

            $user->images()->saveMany(Image::factory(5)->create());
        });
    }
}