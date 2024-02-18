<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;

class AdminUserTest extends TestCase
{
    protected $admin;
    protected $testUser;
    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => '0']);
        $this->actingAs($this->admin);

    }


    public function test_getAllUsers(): void
    {

        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }
    public function test_getOneUser(): void  {

        $response = $this->get('/api/users/' . $this->admin->id);

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
        
        $response = $this->post('/api/users', $userData);

        $response->assertStatus(201);
    }
    public function test_updateUser(): void{
        $userData = [
            'role' => 0,
            "firstname"=> 'Nouveau prénom',
            "lastname"=> 'Nouveau nom',
            "birthdate"=> '1990-01-01',
            "email"=> 'nouveau@email.com',
            "phone_number"=> '1234567890',
            "password"=> 'nouveaumotdepasse',
            "image_ids"=> []    
        ];
        $response = $this->put('api/users/' . $this->admin->id, $userData);
        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
