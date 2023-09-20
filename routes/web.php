<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::post('/', [PostController::class, 'store'])->name('posts.store');

// Definisi rute POST untuk mengirim pesan kustom
Route::post('/custom', [PostController::class, 'sendCustomMessage'])->name('posts.sendCustomMessage');

Route::resource('/posts', \App\Http\Controllers\PostController::class);

// Rute tambahan untuk mengirim pesan kustom (memastikan tidak ada duplikasi)
Route::post('posts/sendCustomMessage', [PostController::class, 'sendCustomMessage'])->name('posts.sendCustomMessage');
