<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PortfolioController;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// */

// Route::get('/', [PortfolioController::class, 'index'])->name('home');
// Route::get('/projects', [PortfolioController::class, 'allProjects'])->name('projects.all');
// Route::get('/project/{slug}', [PortfolioController::class, 'showProject'])->name('project.show');

// // Routes untuk personal projects
// Route::get('/personal-projects', [PortfolioController::class, 'allPersonalProjects'])->name('personal.projects.all');
// Route::get('/personal-project/{slug}', [PortfolioController::class, 'showPersonalProject'])->name('personal.project.show');
// // Tambahkan di akhir web.php
// Route::prefix('admin')->group(base_path('routes/admin.php'));   


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Portfolio Routes
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/projects', [PortfolioController::class, 'allProjects'])->name('projects.all');
Route::get('/project/{slug}', [PortfolioController::class, 'showProject'])->name('project.show');
Route::get('/personal-projects', [PortfolioController::class, 'allPersonalProjects'])->name('personal.projects.all');
Route::get('/personal-project/{slug}', [PortfolioController::class, 'showPersonalProject'])->name('personal.project.show');

// Admin Routes - IMPORTANT: harus diletakkan sebelum route apapun yang menangkap '/admin/*'
Route::prefix('admin')->group(function () {
    require __DIR__.'/admin.php';
});

// Fallback atau routes lainnya
Route::fallback(function () {
    return view('errors.404');
});