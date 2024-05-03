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
        User::factory(10)->hasAddresses(2)->hasImages(5)->create();
    }
}