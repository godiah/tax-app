<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories Routes
    Route::resource('categories', CategoryController::class);
    Route::get('/admin/modal/create-category', function () {
        return view('admin.categories.create-modal');
    })->name('admin.categories.create-modal');
    Route::get('/check-title', [CategoryController::class, 'checkTitle'])->name('check-title');

    // Tag Routes
    Route::resource('tags', TagController::class)->except(['show']);
    Route::get('/admin/modal/create-tag', function () {
        return view('admin.tags.create-modal');
    })->name('admin.tags.create-modal');

    // Post Routes
    Route::resource('posts', PostController::class);
    Route::patch('/posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
});
