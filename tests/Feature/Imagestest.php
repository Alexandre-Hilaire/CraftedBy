<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Pmodel;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class ImagesTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);
    }

    public function testGetAllImages(): void {

        $response = $this->get('/images');

        $response->assertStatus(200);
    }

    public function testGetOneImage(): void {

        $pmodel = Pmodel::factory()->create();
        $product = Product::factory()->create(['pmodel_id' => $pmodel->id]);

        $image = Image::factory()->create(['imagable_type'=> 'product', 'imagable_id'=> $product->id]);

        $response = $this->get('/images/' . $image->id);

        $response->assertStatus(200);
    }

protected function tearDown(): void {
        parent::tearDown();
    }    
}
