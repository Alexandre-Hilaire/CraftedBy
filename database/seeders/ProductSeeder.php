<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Material;
use App\Models\Pmodel;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(20)
        ->has(Category::factory(1))
        ->has(Material::factory(1))
        ->has(Pmodel::factory(1))
        ->has(Image::factory(5))
        ->create();
    }
}
