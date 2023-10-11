<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDataTest extends TestCase
{
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
