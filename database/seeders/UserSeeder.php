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
        User::factory(10)
        ->has(Address::factory(2)
        ->has(Crafter::factory(1))
        ->has(Product::factory(2))
        ->has(Image::factory(5))
        )
        ->create();
    }
}