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

Route::middleware('auth:sanctum')->get('/login', function (Request $request) {
});
Route::middleware('auth:sanctum')->get('/logout', [loginApiController::class,'logout']);
Route::get('/showapi/{token}', [\App\Http\Controllers\showJsonController::class, "genInfos"])->name('showapi');
Route::get('posts/{slug}/{token}', [\App\Http\Controllers\showJsonController::class, "show"]);


