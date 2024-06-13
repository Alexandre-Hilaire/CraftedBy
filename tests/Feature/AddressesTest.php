<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;
use Tests\TestCase;
use App\Models\Address;

class AddressesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $admin;
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);
    }

    public function testGetAllAddresses(): void {
        $response = $this->get('/addresses');

        $response->assertStatus(200);
    }

    public function testShowOneAddress() : void {
        $address = Address::factory()->create();

        $response = $this->get('/addresses/' .$address->id);

        $response->assertStatus(200);
    }

    public function testGetUserAddresses(): void {

        $address = Address::factory(10)->create(['user_id' => $this->admin->id]);

        $response = $this->get('/addresses/search/' . $this->admin->id);

        $response->assertStatus(200);

    }

    public function testCreateAdress(): void {
        $faker = Faker::create();

        $addressData = [
            'user_id' => $this->admin->id,
            'address_name' => $faker->firstName,
            'address_type' => 0,
            'address_firstname' => $faker->firstName,
            'address_lastname' => $faker->firstName,
            'first_address' => $faker->streetAddress,
            'second_address' => $faker->streetAddress,
            'postal_code' => "07500"
        ];
        $response = $this->post('/addresses', $addressData);

        $response->assertStatus(201);
    }

    public function testUpdateAddress(): void {
        $faker = Faker::create();

        $address = Address::factory()->create();
        $addressData = [
            'user_id' => $this->admin->id,
            'address_name' => $faker->firstName,
            'address_type' => 0,
            'address_firstname' => $faker->firstName,
            'address_lastname' => $faker->firstName,
            'first_address' => $faker->streetAddress,
            'second_address' => $faker->streetAddress,
            'postal_code' => "07500"
        ];

        $response = $this->put('/addresses/' . $address->id, $addressData);

        $response->assertStatus(200);
    }

    public function testDeleteAddress(): void{

        $address = Address::factory()->create();

        $response = $this->delete('/addresses/'. $address->id );

        $response->assertStatus(200);
    }

    protected function tearDown(): void {
        parent::tearDown();
    }
}
