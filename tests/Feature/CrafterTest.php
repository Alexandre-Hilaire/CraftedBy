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

    protected function tearDown(): void {
        parent::tearDown();
    }

}
