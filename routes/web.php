<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Etalase publik (produk dimuat dengan eager loading)
Route::get('/', [ShopController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Profile (Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Custom RoleMiddleware: hanya admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-area', [AreaController::class, 'admin'])->name('admin.area');
    });

    // Custom RoleMiddleware: admin atau editor
    Route::middleware('role:admin,editor')->group(function () {
        Route::get('/editor-area', [AreaController::class, 'editor'])->name('editor.area');
        Route::get('/demo/eager-loading', [AreaController::class, 'eagerLoading'])->name('demo.eager');
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    });

    // Otorisasi per-record lewat PostPolicy (Gate::authorize di controller)
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

require __DIR__.'/auth.php';
