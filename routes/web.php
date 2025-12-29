<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsulanController;

// Route::get('/', function () {
//     return view('welcome');
// });

// 1. Halaman Utama (GET /) langsung memanggil fungsi index di Controller
Route::get('/', [UsulanController::class, 'index'])->name('usulan.index');

// 2. Proses Form (POST /) mengirim data ke fungsi store
// Saya ubah url-nya jadi '/' juga agar rapi, tapi method-nya POST
Route::post('/', [UsulanController::class, 'store'])->name('usulan.store');
