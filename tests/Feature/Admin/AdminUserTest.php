<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    protected $admin;
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

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
