<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UnsubscribeController;
use App\View\Components\BlogSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Blog Routes
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/posts/{post:slug}/like', [PostLikeController::class, 'toggle'])->name('posts.like')->middleware('web');
Route::get('/blog/tag/{tag:slug}', [BlogController::class, 'postsByTag'])->name('blog.tag');

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
    Route::post('/newsletter/subscribe', [SubscriberController::class, 'subscribe'])->name('newsletter.subscribe');
    Route::get('/newsletter/unsubscribe/{token}', [UnsubscribeController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
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

    // Activity Routes
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('activities/filter', [ActivityController::class, 'filter'])->name('activities.filter');

    // Profile Routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::patch('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // Analytics Routes
    Route::get('analytics', [AnalyticController::class, 'index'])->name('analytics');
});
