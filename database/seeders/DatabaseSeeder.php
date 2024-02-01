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
            // ProductSeeder::class,
            PmodelSeeder::class,
            // CategorySeeder::class,
            // MaterialSeeder::class,
            AddressSeeder::class,
            UserSeeder::class,
            ImageSeeder::class,
            CrafterSeeder::class,
            // OrderSeeder::class,
        ]);
    }
}
