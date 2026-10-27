<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Support\PublicImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

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

// Public media fallback for hosts where the storage symlink is unavailable.
Route::get('/media/{path}', function (string $path) {
    $path = PublicImage::normalize($path);

    abort_if($path === '' || str_contains($path, '..') || ! Storage::disk('public')->exists($path), 404);

    return response()->file(Storage::disk('public')->path($path), [
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*')->name('media.show');

// Contact Form Route
Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

// Admin Routes
Route::prefix('admin')->group(function () {
    require __DIR__.'/admin.php';
});

// Fallback
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
