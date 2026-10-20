<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

// Login / registration (only for visitors who are not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Everything about portfolios requires login
Route::middleware('auth')->group(function () {

    // Create a new portfolio
    Route::get('/create-portfolio', [PortfolioController::class, 'create'])
        ->name('portfolio.create');

    Route::post('/create-portfolio', [PortfolioController::class, 'store'])
        ->name('portfolio.store');

    // Template selection
    Route::get('/templates/{portfolio}', [PortfolioController::class, 'templates'])
        ->name('portfolio.templates');

    Route::post('/templates/{portfolio}', [PortfolioController::class, 'selectTemplate'])
        ->name('portfolio.select-template');

    // Save Portfolio (button at the bottom of the preview)
    Route::post('/portfolio/{portfolio}/save', [PortfolioController::class, 'save'])
        ->name('portfolio.save');

    // Portfolio preview
    Route::get('/preview/{portfolio}/{template?}', [PortfolioController::class, 'preview'])
        ->name('portfolio.preview');

    // My Portfolios
    Route::get('/manage-portfolio', [PortfolioController::class, 'manage'])
        ->name('portfolio.manage');

    // Edit / update / delete
    Route::get('/portfolio/{portfolio}/edit', [PortfolioController::class, 'edit'])
        ->name('portfolio.edit');

    Route::put('/portfolio/{portfolio}', [PortfolioController::class, 'update'])
        ->name('portfolio.update');

    Route::delete('/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])
        ->name('portfolio.destroy');
});