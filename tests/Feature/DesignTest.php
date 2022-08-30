<?php

namespace Tests\Feature;

use App\Models\Design;
use App\Models\DesignCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DesignTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_design_route()
    {
        $this->get('/designs')->assertStatus(200);
    }

    public function test_see_design_test()
    {
        $this->get('/designs')->assertSeeText('Design.');
    }

    public function test_see_design()
    {
        $latest = Design::latest()->first();
        $this->get('/designs')->assertSeeText($latest->title);
    }

    public function test_keyword_found()
    {
        $this->get('/designs?keyword=Design+2')->assertStatus(200)->assertSeeText('Design 2');
    }

    public function test_keyword_not_found()
    {
        $this->get('/designs?keyword=designdoesntexist')->assertStatus(200)->assertSeeText('Tidak ada design terkait');
    }

    public function test_open_design()
    {
        $latest = Design::latest()->first();
        $this->get('/designs/' . $latest->slug)->assertStatus(200)->assertSeeText($latest->title);
    }

    public function test_open_not_exist_design_should_redirect_to_design_page()
    {
        $this->get('/designs/notexistdesign')->assertRedirect('/designs');
    }

    public function test_category_web() {
        $webId = DesignCategory::where('category_name', 'Web')->first();
        $latestWeb = Design::where('design_category_id', $webId->id)->latest()->first();


        $this->get('/designs?category=Web')->assertSeeText($latestWeb->title);
    }

    public function test_category_web_should_not_let_other_category_appear()
    {
        $webId = DesignCategory::where('category_name', 'Illustration')->first();
        $latestIllustration = Design::where('design_category_id', $webId->id)->latest()->first()->first();

        $this->get('/designs?category=Web')->assertDontSeeText($latestIllustration->title);
    }

    public function test_category_illustration()
    {
        $webId = DesignCategory::where('category_name', 'Illustration')->first();
        $latestIllustration = Design::where('design_category_id', $webId->id)->latest()->first()->first();

        $this->get('/designs?category=Illustration')->assertSeeText($latestIllustration->title);
    }

    public function test_category_illustration_should_not_let_other_category_appear()
    {
        $webId = DesignCategory::where('category_name', 'Web')->first();
        $latestWeb = Design::where('design_category_id', $webId->id)->latest()->first();

        $this->get('/designs?category=Illustration')->assertDontSeeText($latestWeb->title);
    }


    public function test_category_doesnt_exist()
    {
        $this->get('/designs?category=noneexistcategory')->assertSeeText('Tidak ada design terkait');
    }

    public function test_keyword_with_category()
    {
        $web = Design::where('title', 'LIKE', '%design%')->first();
        $this->get('/designs?category=Web&&keyword=Design')->assertSeeText($web->title);
    }

    public function test_non_exist_keyword_with_category()
    {
        $this->get('/designs?category=Web&&keyword=noneexistkeyword')->assertSeeText('Tidak ada design terkait');
    }
}
