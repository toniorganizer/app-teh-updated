<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDataTest extends TestCase
{

    // untuk test yang memerlukan login
    protected function setUp(): void
    {
        parent::setUp();
        // $user = User::first();
        // $this->actingAs($user);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_data()
    {
        $response = $this->get('/user-data');

        $response->assertStatus(200);
    }

    public function test_user_login()
    {
        $response = $this->get('/user-login');
        $response = $this->get('/user-register');

        $response->assertStatus(200);
    }
}
