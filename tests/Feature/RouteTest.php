<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    private $user = [
        'username' => 'kerelka',
        'password' => 'kmzwa88saa'
    ];
    /**
     * A basic feature test example.
     *
     * @return void
     */
   public function test_route_home() {
       $this->get('/')->assertStatus(200);
   }

   public function test_route_about_me() {
       $this->get('/aboutme')->assertStatus(200);
   }

   public function test_route_blogs() {
       $this->get('/blogs')->assertStatus(200);
   }

   public function test_route_projects() {
       $this->get('/projects')->assertStatus(200);
   }

   public function test_route_designs() {
       $this->get('/designs')->assertStatus(200);
   }

   public function test_route_login() {
       $this->get('/login')->assertStatus(200);
   }

   public function test_route_admin_dashboard() {
       $this->post('/login', $this->user)->assertRedirect('/dashboard');
   }

   public function test_route_admin_blog() {
       $this->post('/login', $this->user)->assertRedirect('/dashboard');

       $this->get('/admin/blog')->assertStatus(200);
   }

   public function test_route_admin_design() {
       $this->post('/login', $this->user)->assertRedirect('/dashboard');

       $this->get('/admin/design')->assertStatus(200);
   }

   public function test_route_admin_project() {
       $this->post('/login', $this->user)->assertRedirect('/dashboard');

       $this->get('/admin/project')->assertStatus(200);
   }

   public function test_route_admin_setting() {
       $this->post('/login', $this->user)->assertRedirect('/dashboard');

       $this->get('/setting')->assertStatus(200);
   }

   public function test_admin_dashboard_without_login() {
       $this->get('/dashboard')->assertRedirect('/login');
   }

   public function test_admin_blog_without_login() {
       $this->get('/admin/blog')->assertRedirect('/login');
   }

   public function test_admin_design_without_login() {
       $this->get('/admin/design')->assertRedirect('/login');
   }

   public function test_admin_project_without_login() {
       $this->get('/admin/project')->assertRedirect('/login');
   }

   public function test_admin_setting_without_login() {
       $this->get('/setting')->assertRedirect('/login');
   }
}
