<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminSubmissionController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SubmissionController::class, 'landing'])->name('landing');

Route::redirect('/submit', '/#demo-form')->name('submit.create');
Route::post('/submit', [SubmissionController::class, 'store'])
    ->middleware('throttle:submission')
    ->name('submit.store');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'store'])
        ->middleware('throttle:admin-login')
        ->name('admin.login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/submissions', [AdminSubmissionController::class, 'index'])->name('submissions.index');
        Route::get('/submissions/{submission}', [AdminSubmissionController::class, 'show'])->name('submissions.show');
        Route::delete('/submissions/{submission}', [AdminSubmissionController::class, 'destroy'])->name('submissions.destroy');
        Route::get('/files/{submission}', [AdminSubmissionController::class, 'downloadFile'])->name('files.download');
    });
});
