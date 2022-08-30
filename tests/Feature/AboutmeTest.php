<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutmeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_about_me_route()
    {
        $this->get('/aboutme')->assertStatus(200);
    }

    public function test_see_name()
    {
        $this->get('/aboutme')->assertStatus(200)->assertSeeText('KEREL KHALIF AFIF');
    }

    public function test_see_experience()
    {
        $this->get('/aboutme')->assertStatus(200)->assertSeeText('EXPERIENCE');
    }

    public function test_see_download_cv()
    {
        $this->get('/aboutme')->assertStatus(200)->assertSeeText('Download CV');
    }

    public function test_see_portfolio()
    {
        $this->get('/aboutme')->assertStatus(200)->assertSeeText('Portfolio');
    }

    public function test_see_contact_me()
    {
        $this->get('/aboutme')->assertStatus(200)->assertSeeText('Contact Me');
    }
}
