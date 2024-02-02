<?php

namespace Database\Seeders;

use App\Models\Pmodel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PmodelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pmodel::factory(10)
        ->create();
    }
}