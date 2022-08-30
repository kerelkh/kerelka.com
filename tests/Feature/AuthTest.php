<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_route()
    {
        $this->get('/login')->assertStatus(200);
    }

    public function test_login_post()
    {
        $this->post('/login', [
            'username' => 'kerelka',
            'password' => 'kmzwa88saa',
        ])->assertRedirect('/dashboard');
    }

    public function test_login_redirect_if_already_login()
    {
        $this->post('/login', [
            'username' => 'kerelka',
            'password' => 'kmzwa88saa',
        ]);
        $this->get('/login')->assertRedirect('/dashboard');
    }

    public function test_login_failed()
    {
        $this->post('/login', [
            'username' => 'kerelka',
            'password' => 'wrongpassword'
        ])->assertSessionHas('error')->assertStatus(302);
    }

    public function test_logout()
    {
        $this->post('/login', [
            'username' => 'kerelka',
            'password' => 'kmzwa88saa'
        ])->assertRedirect('/dashboard');

        $this->post('/logout')->assertRedirect('/login');
    }
}
