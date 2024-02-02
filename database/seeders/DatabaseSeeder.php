<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([

            // * fonctionne
            PmodelSeeder::class,
            // * fonctionne
            CategorySeeder::class,
            // * fonctionne
            MaterialSeeder::class,
            // ! ne fonctionne pas
            UserSeeder::class,
            // ! ne fonctionne pas
            ProductSeeder::class,
            // ! ne fonctionne pas
            CrafterSeeder::class,
            // ! ne fonctionne pas
            OrderSeeder::class,
        ]);
    }
}
