<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile dari Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Role middleware
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-area', function () {
            return 'Admin Area';
        })->name('admin.area');
    });

    Route::middleware('role:admin,editor')->group(function () {
        Route::get('/editor-area', function () {
            return 'Admin / Editor Area';
        })->name('editor.area');
    });

    // Post Policy
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');
});

require __DIR__.'/auth.php';