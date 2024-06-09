<?php

namespace Tests\Feature;

use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class MaterialTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);
    }

    public function testGetAllMaterials(): void {

        $response = $this->get('/materials');

        $response->assertStatus(200);
    }

    public function testGetOneMaterial(): void {
        $material = Material::factory()->create();

        $response = $this->get('/materials/' . $material->id);

        $response->assertStatus(200);
    }

    public function testCreateMaterial(): void {
        $faker = Faker::create();

        $materialData = [
            'material_name' => $faker->name
        ];

        $response = $this->post('/materials', $materialData);

        $response->assertStatus(201);
    }

    protected function tearDown(): void {
        parent::tearDown();
    }
}
