<?php

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

// Login via token
Route::get('/login', [\App\Http\Controllers\Api\loginApiController::class, 'returnViewLogin'])->name("login");

Route::post('/login-api', [\App\Http\Controllers\Api\loginApiController::class, 'login'])->name('login-api');

// Logout — precisa do token no header
Route::middleware('auth:sanctum')->post('/logout-api', [\App\Http\Controllers\Api\loginApiController::class, 'logout']);

// Rota protegida para mostrar infos (com token no header)
Route::middleware('auth:sanctum')->get('/showapi', [\App\Http\Controllers\showJsonController::class, 'genInfos'])->name('showapi');

// Rota protegida para pegar um post por slug
Route::middleware('auth:sanctum')->get('/posts/{slug}', [\App\Http\Controllers\showJsonController::class, 'show']);



