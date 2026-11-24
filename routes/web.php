<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| Beranda Awal
|--------------------------------------------------------------------------
| Route "reports.create" dan "reports.show" dipertahankan hanya karena
| dipanggil lewat route() di view Beranda. Halaman tujuannya sudah dihapus.
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/lapor/{type}', [PublicController::class, 'create'])->whereIn('type', ['lost', 'found'])->name('reports.create');
Route::post('/lapor/{type}', [ReportController::class, 'store'])->whereIn('type', ['lost', 'found'])->name('reports.store');
Route::get('/barang/{report}', [PublicController::class, 'show'])->name('reports.show');

/*
|--------------------------------------------------------------------------
| Login Admin
|--------------------------------------------------------------------------
| Route "admin.dashboard" dipertahankan karena dipakai redirect setelah login
| berhasil. Halaman dashboard-nya sudah dihapus.
*/
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});
