<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crafter>
 */
class CrafterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' =>fake()->uuid(),
            'information' => fake() -> realText($maxNbChars = 300),
            'story' => fake() -> realText($maxNbChars = 300),
            'crafting_process' => fake() -> realText($maxNbChars = 300),
            'location' => fake() -> city(),
            'material_preference' => fake() -> realText($maxNbChars = 100),
        ];
    }
}
