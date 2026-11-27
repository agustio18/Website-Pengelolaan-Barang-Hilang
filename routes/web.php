<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\HandoverController;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/lapor/{type}', [PublicController::class, 'create'])->whereIn('type', ['lost', 'found'])->name('reports.create');
Route::post('/lapor/{type}', [ReportController::class, 'store'])->whereIn('type', ['lost', 'found'])->name('reports.store');

Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::post('/verification/{report}/approve', [VerificationController::class, 'approve'])->name('verification.approve');
    Route::post('/verification/{report}/reject', [VerificationController::class, 'reject'])->name('verification.reject');
    Route::get('/handovers', [HandoverController::class, 'index'])->name('handovers.index');
    Route::post('/handovers/{report}', [HandoverController::class, 'store'])->name('handovers.store');
});
