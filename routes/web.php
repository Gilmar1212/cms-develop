<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\indexController::class, 'index'])->name('home');

Route::prefix('/blog')->name('blog.')->controller(\App\Http\Controllers\blogController::class)->group( function () {
    Route::get('/', 'index')->name('home');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
    Route::get('/post-area', 'create')->name('create');
    Route::post('/post', 'store')->name('store');
    Route::get('/edit/{id?}', 'edit')->name('edit');
    Route::put('/edit/{id?}', 'update')->name('update');
});


