<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_user_can_access_to_dashboard()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }
    /*
    public function test_if_login_redirect_to_dashboard()
    {
        $user = factory(User::class)->create();
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    } */
}
