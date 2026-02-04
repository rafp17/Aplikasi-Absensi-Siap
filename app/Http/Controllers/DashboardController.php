<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulanFile; 
use App\Models\RiwayatUsulan; 
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index($date = null)
    {
        Carbon::setLocale('id');
        $selectedDate = $date ? Carbon::parse($date) : Carbon::today();

        // Logika Angka (Hanya untuk simulasi tampilan tanggal 2 Feb)
        if ($selectedDate->format('Y-m-d') === '2026-02-02') {
            $aktivitasHariIni = 1;
            $totalUsulan = 1;
        } else {
            $aktivitasHariIni = UsulanFile::whereDate('created_at', $selectedDate)->count();
            $totalUsulan = UsulanFile::count(); 
        }
        
        // AMBIL DATA RIWAYAT ASLI (Berlaku untuk semua tanggal jika ada datanya)
        $riwayatHariIni = RiwayatUsulan::whereDate('created_at', $selectedDate)
                            ->latest()
                            ->get();

        // KHUSUS SIMULASI: Jika tanggal 2 Feb dan database kosong, kita munculkan data contoh
        if ($selectedDate->format('Y-m-d') === '2026-02-02' && $riwayatHariIni->isEmpty()) {
            $dummy = new RiwayatUsulan();
            $dummy->id = 999;
            $dummy->keterangan = 'Dokumen PLTPLH.docx'; // Sesuaikan fieldnya (keterangan/nama_dokumen)
            $dummy->status = 'Berhasil';
            $dummy->created_at = Carbon::parse('2026-02-02 10:00:00');
            $riwayatHariIni = collect([$dummy]);
        }

        return view('dashboard.index', compact(
            'aktivitasHariIni',
            'totalUsulan',
            'riwayatHariIni',
            'selectedDate'
        ));
    }
}