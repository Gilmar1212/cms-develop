<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ["App\Http\Controllers\indexController", "index"])->name('home');
Route::get('/blog', ["App\Http\Controllers\blogController", "blog"])->name('blog');
Route::post('/blog', ["App\Http\Controllers\blogController", "store"])->name('store');
