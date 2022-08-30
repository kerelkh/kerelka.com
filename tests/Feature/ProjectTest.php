<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_project_route()
    {
       $this->get('/projects')->assertStatus(200);
    }

    public function test_latest_project()
    {
        $latest = Project::latest()->first();

        $this->get('/projects')->assertStatus(200)->assertSeeText($latest->title);
    }

    public function test_keyword_found()
    {
        $find = Project::first();

        $this->get('/projects?keyword=project')->assertStatus(200)->assertSeeText($find->title);
    }

    public function test_keyword_not_found()
    {
        $this->get('/projects?keyword=thistitledoesntexist')->assertStatus(200)->assertSeeText('Tidak ada project terkait');
    }

    public function test_open_project()
    {
        $latest = Project::latest()->first();
        $response = $this->get('/projects/' . $latest->slug)->assertStatus(200);

        $response->assertSeeText($latest->title);
    }

    public function test_open_non_exist_project()
    {
        $this->get('/projects/notexistproject')->assertRedirect('/projects');
    }
}
