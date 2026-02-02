<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PltplhController;
use App\Http\Controllers\UsulanFileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\DokumenController; // Tambahan berdasarkan struktur VS Code kamu

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Halaman "Aplikasi Layanan" (Gambar 1) telah dihapus dari alur ini.
| Sekarang, aplikasi langsung memuat Dashboard (Gambar 2).
*/

// === DASHBOARD (Ganti Gambar 1 ke Gambar 2) ===
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);


// === MENU PLT/PLH ===
Route::get('/plt-plh', [PltplhController::class, 'pltPlhIndex'])->name('plt-plh.index');
Route::post('/plt-plh/store', [PltplhController::class, 'store'])->name('plt.store');


// === MENU MUTASI ===
Route::resource('mutasi', MutasiController::class);
Route::get('mutasi/{mutasi}/download', [MutasiController::class, 'downloadSk'])->name('mutasi.download');


// === MENU REKOM KATIM ===
Route::get('/rekom-katim', [UsulanFileController::class, 'index'])->name('usulan.files');


// === MENU DOKUMEN (Berdasarkan DokumenController.php di VS Code) ===
Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');


// === DATA API (Untuk Widget Riwayat Hari Ini) ===
Route::get('/usulan-today', [UsulanFileController::class, 'today'])->name('usulan.files.today');