<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscribeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/aboutme', [AboutMeController::class, 'index'])->name('aboutme');
Route::post('/aboutme', [AboutMeController::class,'storecontact']);
Route::get('/contact', function() {
  return "hi this is contact";
});
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/{slug}', [PostController::class, 'showpost']);
Route::get('/designs', [DesignController::class, 'index'])->name('designs');
Route::get('/designs/{slug}', [DesignController::class, 'showdesign']);
Route::get('/projects', [ProjectController::class,'index'])->name('projects');
Route::get('/projects/{slug}', [ProjectController::class, 'showproject']);


Route::middleware(['guest'])->group(function() {
  Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
  Route::post('/login', [AuthController::class, 'authLogin']);
  Route::post('/subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');
});

Route::middleware(['auth'])->group(function() {
  Route::name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('admin/blog', [DashboardController::class, 'blog'])->name('blog');
    Route::get('admin/design', [DashboardController::class, 'design'])->name('design');
    Route::get('admin/design/{design:slug}', [DesignController::class, 'showedit']);
    Route::post('admin/design/{design:slug}', [DesignController::class, 'update']);
    Route::delete('admin/design/{design:slug}/delete', [DesignController::class, 'delete'])->name('design.delete');
    Route::get('admin/project', [DashboardController::class, 'project'])->name('project');
    Route::post('admin/project', [ProjectController::class, 'storeproject']);
    Route::get('admin/project/{project:slug}', [ProjectController::class, 'showedit']);
    Route::post('admin/project/{project:slug}', [ProjectController::class, 'update']);
    Route::delete('admin/project/{project:slug}/delete', [ProjectController::class, 'delete'])->name('project.delete');
    Route::get('setting', [DashboardController::class, 'setting'])->name('setting');
  });

  Route::get('/admin/blog/{post:slug}', [PostController::class, 'editpost']);
  Route::post('/posts', [PostController::class, 'storepost']);
  Route::put('/posts/{post:slug}', [PostController::class, 'storeedit']);
  Route::delete('/posts/{post:slug}', [PostController::class, 'delete']);
  Route::post('/logout', [AuthController::class, 'authLogout'])->name('auth.logout');
  Route::post('admin/design', [DesignController::class, 'storecategory']);
  Route::post('admin/storedesign', [DesignController::class, 'storedesign'])->name('store.design');
  Route::delete('admin/design/{category_name}', [DesignController::class, 'deletecategory']);
});
