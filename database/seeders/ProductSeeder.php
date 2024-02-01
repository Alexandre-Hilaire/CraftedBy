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
        Product::factory(20)->create()->each(function ($product){
            $product->category()->associate(Category::factory()->create());
            $product->material()->associate(Material::factory()->create());
            $product->pmodel()->associate(Pmodel::factory()->create());
            $product->save();
            $product->images()->saveMany(Image::factory(5)->create());
        });
    }
}
