<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TwilioController; // Assuming TwilioController exists

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::post('/', [PostController::class, 'store'])->name('posts.store');

// Define a route for sending custom messages
Route::post('/custom', [PostController::class, 'sendCustomMessage'])->name('posts.sendCustomMessage');

// Resourceful routes for posts
Route::resource('/posts', PostController::class);

// Additional route for sending custom messages (ensure no duplication)
Route::post('/posts/sendCustomMessage', [PostController::class, 'sendCustomMessage'])->name('posts.sendCustomMessage');

// Route for Twilio status callback
Route::post('/twilio/status', [TwilioController::class, 'statusCallback'])->name('twilio.statusCallback');
