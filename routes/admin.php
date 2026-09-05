<?php

use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\PersonalProjectController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('admin.login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:admin-login');

    if (config('app.allow_admin_registration')) {
        Route::get('/register', [AuthController::class, 'showRegister'])->name('admin.register');
        Route::post('/register', [AuthController::class, 'register']);
    } else {
        Route::match(['get', 'post'], '/register', fn () => abort(404));
    }
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');

    Route::get('/personal-projects', [PersonalProjectController::class, 'index'])->name('admin.personal-projects.index');
    Route::get('/personal-projects/create', [PersonalProjectController::class, 'create'])->name('admin.personal-projects.create');
    Route::post('/personal-projects', [PersonalProjectController::class, 'store'])->name('admin.personal-projects.store');
    Route::get('/personal-projects/{personalProject}/edit', [PersonalProjectController::class, 'edit'])->name('admin.personal-projects.edit');
    Route::put('/personal-projects/{personalProject}', [PersonalProjectController::class, 'update'])->name('admin.personal-projects.update');
    Route::delete('/personal-projects/{personalProject}', [PersonalProjectController::class, 'destroy'])->name('admin.personal-projects.destroy');

    Route::get('/experiences', [ExperienceController::class, 'index'])->name('admin.experiences.index');
    Route::get('/experiences/create', [ExperienceController::class, 'create'])->name('admin.experiences.create');
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('admin.experiences.store');
    Route::get('/experiences/{experience}/edit', [ExperienceController::class, 'edit'])->name('admin.experiences.edit');
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('admin.experiences.update');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('admin.experiences.destroy');

    Route::get('/skills', [SkillController::class, 'index'])->name('admin.skills.index');
    Route::get('/skills/create', [SkillController::class, 'create'])->name('admin.skills.create');
    Route::post('/skills', [SkillController::class, 'store'])->name('admin.skills.store');
    Route::get('/skills/{skill}/edit', [SkillController::class, 'edit'])->name('admin.skills.edit');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('admin.skills.update');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('admin.skills.destroy');

    Route::get('/education', [EducationController::class, 'index'])->name('admin.education.index');
    Route::get('/education/create', [EducationController::class, 'create'])->name('admin.education.create');
    Route::post('/education', [EducationController::class, 'store'])->name('admin.education.store');
    Route::get('/education/{education}/edit', [EducationController::class, 'edit'])->name('admin.education.edit');
    Route::put('/education/{education}', [EducationController::class, 'update'])->name('admin.education.update');
    Route::delete('/education/{education}', [EducationController::class, 'destroy'])->name('admin.education.destroy');

    Route::get('/certifications', [CertificationController::class, 'index'])->name('admin.certifications.index');
    Route::get('/certifications/create', [CertificationController::class, 'create'])->name('admin.certifications.create');
    Route::post('/certifications', [CertificationController::class, 'store'])->name('admin.certifications.store');
    Route::get('/certifications/{certification}/edit', [CertificationController::class, 'edit'])->name('admin.certifications.edit');
    Route::put('/certifications/{certification}', [CertificationController::class, 'update'])->name('admin.certifications.update');
    Route::delete('/certifications/{certification}', [CertificationController::class, 'destroy'])->name('admin.certifications.destroy');

    Route::get('/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
});
