<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Pmodel;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class OrdersTest extends TestCase
{

    use RefreshDatabase;

    protected $admin;
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);
    }

    public function testGetAllOrders(): void {

        $response = $this->get('/orders');

        $response->assertStatus(200);
    
    }

    public function testGetOneOrder(): void {

        $order = Order::factory()->create();

        $response = $this->get('/orders/' . $order->id);

        $response->assertStatus(200);

    }

    public function testCreateOrder(): void {

        $faker = Faker::create();

        $pmodel = Pmodel::factory()->create();
        $product = Product::factory()->create(['pmodel_id' => $pmodel->id]);

        $orderData = [
            'user_id' => $this->admin->id,
            'delivery_address' => $faker->address,
            'facturation_address' => $faker->address,
            'products' => [$product],
        ];

        $response = $this->post('/orders/', $orderData);

        $response->assertStatus(201);

    }

    public function testUpdateOrder() : void {

        $faker = Faker::create();

        $order = Order::factory()->create();

        $pmodel = Pmodel::factory()->create();

        $product = Product::factory()->create(['pmodel_id' => $pmodel->id]);

        $orderData = [
            'user_id' => $this->admin->id,
            'delivery_address' => $faker->address,
            'facturation_address' => $faker->address,
            'products' => [$product],
        ];

        $response = $this->put('/orders/' . $order->id, $orderData);

        $response->assertStatus(200);

    }

    public function testDeleteOrder(): void {

        $order = Order::factory()->create();

        $response = $this->delete('/orders/' . $order->id);

        $response->assertStatus(200);
    }

    public function testGetOrdersByUser(): void {

        $order = Order::factory()->create(['user_id'=>$this->admin->id]);

        $response = $this->get('/orders/search/' . $this->admin->id);

        $response->assertStatus(200);
    }

    protected function tearDown(): void {
        parent::tearDown();
    }
}
