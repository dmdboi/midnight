<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
use App\Http\Middleware\EnsureUserIsSuperAdmin;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategoryController;

// READ routes (silent auth)
Route::middleware(['auth'])->group(function () {
    // Forum Home
    Route::get('/', fn () => view('welcome'))->name('home');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

    // Boards
    Route::get('/boards/{board:slug}', [BoardController::class, 'show'])->name('boards.show');

    // Threads
    Route::get('/boards/{board:slug}/threads/{thread:slug}', [ThreadController::class, 'show'])->name('threads.show');
});

// WRITE routes (auth + superadmin)
Route::middleware(['auth', 'superadmin'])->group(function () {
    // Categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Boards
    Route::get('/categories/{category:slug}/boards/create', [BoardController::class, 'create'])->name('boards.create');
    Route::post('/categories/{category:slug}/boards', [BoardController::class, 'store'])->name('boards.store');
    Route::get('/boards/{board:slug}/edit', [BoardController::class, 'edit'])->name('boards.edit');
    Route::put('/boards/{board:slug}', [BoardController::class, 'update'])->name('boards.update');
    Route::delete('/boards/{board:slug}', [BoardController::class, 'destroy'])->name('boards.destroy');

    // Threads
    Route::get('/boards/{board:slug}/threads/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('/boards/{board:slug}/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::get('/boards/{board:slug}/threads/{thread:slug}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::put('/boards/{board:slug}/threads/{thread:slug}', [ThreadController::class, 'update'])->name('threads.update');
    Route::delete('/boards/{board:slug}/threads/{thread:slug}', [ThreadController::class, 'destroy'])->name('threads.destroy');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth', EnsureUserIsSuperAdmin::class])->group(function () {
    Volt::route('categories/create', 'categories.create')
        ->name('categories.create');

    Volt::route('categories/{category:slug}/edit', 'categories.edit')
        ->name('categories.edit');

    Volt::route('categories/{category:slug}/boards/create', 'boards.create')
        ->name('boards.create');

    Volt::route('categories/{category:slug}/boards/edit', 'boards.edit')
        ->name('boards.edit');

    Volt::route('boards/{board:slug}/threads/create', 'threads.create')
        ->name('threads.create');
});

require __DIR__ . '/auth.php';
