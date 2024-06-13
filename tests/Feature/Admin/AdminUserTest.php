<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $testUser;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->admin = User::factory()->create(['role' => 0]);
        $this->actingAs($this->admin);

    }


    public function test_getAllUsers(): void
    {

        $response = $this->get('/users');

        $response->assertStatus(200);
    }
    public function test_getOneUser(): void  {

        $response = $this->get('/users/' . $this->admin->id);

        $response->assertStatus(200);
    }
    public function test_createUser(): void {
        $faker = Faker::create();
        $userData = [
                'role' => 0,
                "firstname"=> $faker->firstname,
                "lastname"=> $faker->lastName,
                "birthdate"=> $faker->date(),
                "email"=> $faker->unique()->safeEmail,
                "phone_number"=> $faker->phoneNumber(),
                "password"=> $faker->password,
                "image_ids"=> []
        ];
        
        $response = $this->post('/users', $userData);

        $response->assertStatus(201);
    }
    public function test_updateUser(): void{
        $faker = Faker::create();
        $user = User::factory()->create();
        $userData = [
            'role' => 0,
            "firstname"=> $faker->firstName,
            "lastname"=> $faker->lastName,
            "birthdate"=> $faker->date,
            "email"=> $faker->email,
            "phone_number"=> $faker->phoneNumber,
            "password"=> $faker->password
        ];
        $response = $this->put('/users/' . $user->id, $userData);
        $response->assertStatus(200);
    }

    public function test_deleteUser(): void {
        $response = $this->delete('/users/' . $this->admin->id);

        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
