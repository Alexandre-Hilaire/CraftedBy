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
        Product::factory(20)->hasImages(5)->create()->each(function ($product){
            $category = Category::inRandomOrder()->first();
            $material = Material::inRandomOrder()->first();
            $pmodel = Pmodel::inRandomOrder()->first();
            $product->categories()->attach($category);
            $product->materials()->attach($material);
            $product->pmodel()->associate($pmodel);
        });
    }
}
