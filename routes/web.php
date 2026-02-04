<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PltplhController;
use App\Http\Controllers\UsulanFileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\AuthController;

// ==========================================
// ROUTE AUTENTIKASI (Bisa diakses tanpa login)
// ==========================================
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// ROUTE TERPROTEKSI (Harus Login)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // === DASHBOARD ===
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{date?}', [DashboardController::class, 'index'])->name('dashboard.filter');

    // === MENU PLT/PLH ===
    Route::get('/plt-plh', [PltplhController::class, 'pltPlhIndex'])->name('plt-plh.index');
    Route::post('/plt-plh/store', [PltplhController::class, 'store'])->name('plt.store');

    // === MENU MUTASI ===
    Route::resource('mutasi', MutasiController::class);
    Route::get('mutasi/{mutasi}/download', [MutasiController::class, 'downloadSk'])->name('mutasi.download');

    // === MENU REKOM KATIM ===
    Route::get('/rekom-katim', [UsulanFileController::class, 'index'])->name('rekom-katim.index');
    
    // --- FITUR TRACKING DOKUMEN (BARU) ---
    Route::get('/tracking/{id}', [UsulanFileController::class, 'track'])->name('document.track');

    // === MENU DOKUMEN ===
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');

    // === DATA API ===
    Route::get('/usulan-today', [UsulanFileController::class, 'today'])->name('usulan.files.today');

    // Route untuk melihat detail profil pegawai
    Route::get('/profile/{id}', [PltplhController::class, 'showProfile'])->name('profile.show');

});