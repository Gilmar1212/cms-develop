<?php

use App\Http\Controllers\Api\loginApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login-api', [loginApiController::class,'loginApi'])->name("login-api");
Route::middleware('auth:sanctum')->get('/logout', [loginApiController::class,'logout'])->name("logout");
Route::middleware('auth:sanctum')->get('/showapi/', [\App\Http\Controllers\showJsonController::class, "genInfos"])->name('showapi');
Route::middleware('auth:sanctum')->get('/posts/{slug}', [\App\Http\Controllers\showJsonController::class, "show"]);


