<?php

namespace Tests\Feature;

use App\Models\Crafter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker; 

class CrafterTest extends TestCase
{

    use RefreshDatabase;

    protected $admin;
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);
    }

    public function testGetAllCrafters(): void {
        
        $response = $this->get('/crafters');

        $response->assertStatus(200);
    }

    public function testGetOneCrafter(): void {
        
        $crafter = Crafter::factory()->create();

        $response = $this->get('/crafters/' . $crafter->id);

        $response->assertStatus(200);
    }

    public function testCreateACrafter(): void {
        $faker = Faker::create();

        $crafterData = [
            'user_id' => $this->admin->id,
            'crafter_name' => $faker->firstName,
            'information' => $faker->realText($maxNbChar=500),
            'story' => $faker->realText($maxNbChar=500),
            'crafting_process' => $faker->realText($maxNbChar=500),
            'material_preference' => $faker->realText($maxNbChar=255),
            'location' => $faker->realText($maxNbChar=255),
            'image_ids' => []
        ];

        $response = $this->post('/crafters', $crafterData);

        $response->assertStatus(201);
    }

    protected function tearDown(): void {
        parent::tearDown();
    }

}
