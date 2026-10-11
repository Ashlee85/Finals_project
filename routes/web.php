
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::view('/', 'home')->name('home');

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

// Portfolio preview
Route::get('/preview/{portfolio}/{template?}', [PortfolioController::class, 'preview'])
    ->name('portfolio.preview');

// Manage saved portfolios
Route::get('/manage-portfolio', [PortfolioController::class, 'manage'])
    ->name('portfolio.manage');

// Edit portfolio
Route::get('/portfolio/{portfolio}/edit', [PortfolioController::class, 'edit'])
    ->name('portfolio.edit');

// Update portfolio
Route::put('/portfolio/{portfolio}', [PortfolioController::class, 'update'])
    ->name('portfolio.update');

// Delete portfolio
Route::delete('/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])
    ->name('portfolio.destroy');
