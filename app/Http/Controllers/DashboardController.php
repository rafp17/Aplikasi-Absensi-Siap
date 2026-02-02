<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatUsulan; 
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. DATA STATISTIK (Gambar 2) ---
        
        $hariIni = Carbon::today();

        // Hitung "Aktivitas Hari Ini" (Kotak 1)
        $aktivitasHariIni = RiwayatUsulan::whereDate('created_at', $hariIni)->count();

        // Hitung "Total Usulan" (Kotak 2 - Angka Merah)
        $totalUsulan = RiwayatUsulan::count();

        // Ambil Data "Riwayat Hari Ini" (Untuk Kotak 3 yang akan disamakan ukurannya)
        $riwayatHariIni = RiwayatUsulan::whereDate('created_at', $hariIni)
                            ->latest()
                            ->get();

        // --- 2. KIRIM KE VIEW ---
        // Catatan: Pastikan file view kamu ada di resources/views/dashboard/index.blade.php
        return view('dashboard.index', compact('aktivitasHariIni', 'totalUsulan', 'riwayatHariIni'));
    }
}