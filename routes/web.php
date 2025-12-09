<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::prefix('/login-sys')->name('login-sys.')->controller(\App\Http\Controllers\Api\LoginApiController::class)->group(function(){
    Route::post('/login',[App\Http\Controllers\Api\LoginApiController::class,'login'])->name('login');
    Route::post('/logout',[App\Http\Controllers\Api\LoginApiController::class,'logout'])->name('logout');
});
Route::prefix('/register-sys')->name('register-sys.')->controller(\App\Http\Controllers\BlogController::class)->group( function(){
    Route::get('/register',[App\Http\Controllers\RegisterController::class,'registerView'])->name('register');
    Route::post('/register-usr',[App\Http\Controllers\RegisterController::class,'store'])->name('store-usr');
});
Route::prefix('/blog')->name('blog.')->controller(\App\Http\Controllers\blogController::class)->group( function () {
    Route::get('/', 'index')->name('home');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
    Route::get('/post-area', 'create')->name('create');
    Route::post('/post', 'store')->name('store');
    Route::get('/edit/{id?}', 'edit')->name('edit');
    Route::put('/edit/{id?}', 'update')->name('update');
});