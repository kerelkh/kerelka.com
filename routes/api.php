<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/uploadbanner', [SettingController::class, 'uploadbanner']);
Route::delete('/deletebanner/{id}', [SettingController::class, 'deletebanner']);
Route::post('/notice', [SettingController::class, 'storeNotice']);
Route::post('/menu', [SettingController::class, 'storeMenu']);
Route::delete('/menu/{id}', [SettingController::class, 'deleteMenu']);