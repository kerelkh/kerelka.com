<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_route()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_categories_home()
    {
        $this->get('/')->assertStatus(200)
                ->assertSeeText('Technology')
                ->assertSeeText('Life')
                ->assertSeeText('Programming')
                ->assertSeeText("Business")
                ->assertSeeText('Tutorial');
    }

    public function test_newest_post()
    {
        $newestPost = Post::latest()->first();

        $this->get('/')->assertStatus(200)->assertSeeText($newestPost->title);
    }

    // public function test_email_subscription()
    // {
    //     $random = rand() * 100;
    //     $response = $this->post('/subscribe', [
    //         'email' => 'kerela' . $random . '@gmail.com'
    //     ])->assertSessionDoesntHaveErrors('email');
    // }

    public function test_email_already_subscription()
    {
        $this->post('/subscribe', [
            'email' => 'kerelka@gmail.com'
        ])->assertSessionHasErrors('email');
    }
}
