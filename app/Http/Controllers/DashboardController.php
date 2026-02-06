<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request, $date = null)
    {
        // Menangkap tanggal dari input atau URL, jika kosong gunakan hari ini
        $selectedDate = $date ? Carbon::parse($date) : Carbon::now();
        
        // --- LOGIKA DATA DUMMY MANUAL UNTUK PRESENTASI ---
        
        // Contoh: Jika memilih tanggal 02 Feb 2026, tampilkan data yang kemarin
        if ($selectedDate->format('Y-m-d') == '2026-02-02') {
            $aktivitasHariIni = 1;
            $totalUsulan = 1;
            $riwayatHariIni = collect([
                (object)[
                    'id' => 1,
                    'keterangan' => 'Dokumen PLTPLH.docx',
                    'created_at' => Carbon::parse('2026-02-02 10:00:00')
                ]
            ]);
        } 
        // Contoh: Jika memilih tanggal hari ini (05 Feb 2026)
        elseif ($selectedDate->isToday()) {
            $aktivitasHariIni = 3; // Angka bebas untuk simulasi
            $totalUsulan = 15;
            $riwayatHariIni = collect([
                (object)['id' => 10, 'keterangan' => 'SK_Mutasi_Rendy.pdf', 'created_at' => now()->subHours(2)],
                (object)['id' => 11, 'keterangan' => 'Usulan_PLT_Baru.docx', 'created_at' => now()->subHour()],
            ]);
        }
        // Untuk tanggal lainnya, kita set kosong agar terlihat realistis
        else {
            $aktivitasHariIni = 0;
            $totalUsulan = 12; // Total keseluruhan biasanya tetap ada angkanya
            $riwayatHariIni = collect([]);
        }

        return view('dashboard.index', compact(
            'selectedDate', 
            'aktivitasHariIni', 
            'totalUsulan', 
            'riwayatHariIni'
        ));
    }
}