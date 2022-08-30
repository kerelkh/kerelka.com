<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->get('/blogs')->assertStatus(200);
    }

    public function test_categories()
    {
        $this->get('/blogs')->assertStatus(200)
            ->assertSeeText('Technology')
            ->assertSeeText('Life')
            ->assertSeeText('Business')
            ->assertSeeText('Tutorial')
            ->assertSeeText('Programming');
    }

    public function test_recent_post()
    {
        $recentPost = Post::latest()->first();
        $this->get('/blogs')->assertStatus(200)
            ->assertSeeText($recentPost->title);
    }

    public function test_keyword_post()
    {
        $keywordPost = Post::where('title', 'LIKE', '%Dasar%')->first();

        $this->get('/blogs?keyword=dasar')->assertStatus(200)
            ->assertSeeText($keywordPost->title);
    }

    public function test_keyword_with_not_found_data()
    {
        $this->get('/blogs?keyword=thiskeyworddoesntexist')->assertStatus(200)
            ->assertSeeText('Tidak ada artikel terkait');
    }

    public function test_keyword_and_data_not_found_doesnt_appear()
    {
        $this->get('/blogs?keyword=dasar')->assertStatus(200)
            ->assertDontSeeText('Tidak ada artikel terkait');
    }

    public function test_open_detail_post() {
        $latestPost = Post::latest()->first();

        $this->get('/blogs/' . $latestPost->slug)->assertStatus(200)->assertSeeText($latestPost->title);
    }

    public function test_open_detail_post_doesnt_exist() {
        $this->get('/blogs/this-post-does-not-exist')->assertStatus(302)->assertRedirect('/blogs');
    }
}
