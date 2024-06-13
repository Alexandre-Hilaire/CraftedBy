<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Pmodel;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);
    }

    /**
     * A basic feature test example.
     */
    public function testGetAllProducts(): void{
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function testGetOneProduct(): void {
        
        $p_model = Pmodel::factory()->create();
        $product = Product::factory()->create(['pmodel_id' => $p_model->id]);

        $response = $this->get('/products/' . $product->id);

        $response->assertStatus(200);
    }

    public function testCreateProduct(): void {
        $faker = Faker::create();

        $productData = [
            "user_id" => $this->admin->id,
            "name" => $faker->firstName,
            "pmodel_name" => $faker->firstName,
            "unit_price" => $faker->randomFloat,
            "description" => $faker->realText($maxNbChars=50),
            "status" => rand(0,2),
            "color" => $faker->colorName,
            "customizable" => rand(0,1),
            "is_active" => fake()->boolean(),
            "categories_names" => [],
            "materials_names" => [],
            "image_ids" => []
        ];

        $response = $this->post('/products', $productData);

        $response->assertStatus(201);
    }

    public function testUpdateProduct() : void{
        $faker = Faker::create();
        $p_model = Pmodel::factory()->create();
        $product = Product::factory()->create(['pmodel_id' => $p_model->id]);


        $productData = [
            "user_id" => $this->admin->id,
            "name" => $faker->firstName,
            "pmodel_name" => $p_model->pmodel_name,
            "unit_price" => $faker->randomFloat,
            "description" => $faker->realText($maxNbChars=50),
            "status" => rand(0,2),
            "color" => $faker->colorName,
            "customizable" => rand(0,1),
            "is_active" => fake()->boolean(),
            "categories_names" => [],
            "materials_names" => [],
            "image_ids" => []
        ];

        $response = $this->put('/products/' .$product->id, $productData);

        $response->assertStatus(200);
    }

    public function testDeleteProduct(): void{
        $p_model = Pmodel::factory()->create();
        $product = Product::factory()->create(['pmodel_id' => $p_model->id]);

        $response = $this->delete('/products/'.$product->id);

        $response->assertStatus(200);
    }

    public function testGetProductsByCategories(): void {

        $p_model = Pmodel::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['pmodel_id' => $p_model->id]);

        $response = $this->get('/products/search/'.$category->id , ['categories_ids' => $category->id]);

        $response->assertStatus(200);


    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

}
