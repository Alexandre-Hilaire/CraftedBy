<?php

namespace Database\Factories;

use App\Models\User;
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
        $userWithoutCrafter = User::doesntHave('crafter')->inRandomOrder()->first()->id;
        return [
            'user_id'=> $userWithoutCrafter,
            'crafter_name' => fake()->realText($maxNbChars = 255),
            'information' => fake() -> realText($maxNbChars = 255),
            'story' => fake() -> realText($maxNbChars = 255),
            'crafting_process' => fake() -> realText($maxNbChars = 255),
            'location' => fake() -> city(),
            'material_preference' => fake() -> realText($maxNbChars = 100),
        ];
    }
}
