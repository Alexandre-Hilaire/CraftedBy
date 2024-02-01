<?php

namespace Database\Seeders;

use App\Models\Crafter;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrafterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Crafter::factory(10)
        ->has(Image::factory(5))
        ->create();
    }
}
