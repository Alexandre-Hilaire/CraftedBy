<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);
    }

    public function testGetallCategories(): void {
        $response = $this->get('/categories');

        $response->assertStatus(200);
    }
    
    public function testGetOneCategory(): void {

        $category = Category::factory()->create();

        $response = $this->get('/categories/'.$category->id);

        $response->assertStatus(200);
    }

    public function testCreateCategory(): void {
        $faker = Faker::create();

        $categoryData = [
            'category_name' => $faker->address()
        ];

        $response = $this->post('/categories', $categoryData);

        $response->assertStatus(201);
    }

    public function testUpdateCategory(): void {
        $faker = Faker::create();
        $category = Category::factory()->create();

        $categoryData = [
            'category_name' => $faker->address()
        ];

        $response = $this->put('/categories/'.$category->id, $categoryData);

        $response->assertStatus(200);
    }

    public function testDeleteCategory(): void  {
        $category = Category::factory()->create();

        $response = $this->delete('/categories/' . $category->id);

        $response->assertStatus(200);
    }

    protected function tearDown(): void {
        parent::tearDown();
    }
}
