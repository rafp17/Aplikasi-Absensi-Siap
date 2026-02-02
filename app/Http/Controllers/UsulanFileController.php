<?php

namespace App\Http\Controllers;

use App\Models\UsulanFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Wajib ada untuk fitur upload file

class UsulanFileController extends Controller
{
    /**
     * Menampilkan halaman form (View)
     * Pastikan Route '/plt' mengarah ke method ini jika ingin menampilkan halaman index.blade.php
     */
    public function index()
    {
        // Jika Bung menggunakan method ini untuk menampilkan halaman web:
        return view('plt.index'); 
        
        // TAPI jika method ini khusus untuk API JSON (seperti kode Bung sebelumnya), biarkan begini:
        // $files = UsulanFile::latest()->get();
        // return response()->json($files);
    }

    /**
     * LOGIKA UTAMA: Menyimpan data dari Form ke Database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Menjaga agar data yang masuk sesuai aturan)
        $validated = $request->validate([
            'jenis'          => 'required|string',
            'alasan'         => 'nullable|string',
            'nama_jabatan'   => 'nullable|string',
            'eselon'         => 'nullable|string',
            
            // --- KOLOM BARU ---
            'tujuan_pengiriman' => 'nullable|string', 
            
            'tgl_mulai'      => 'nullable|date',
            'tgl_selesai'    => 'nullable|date',
            'penandatangan'  => 'nullable|string',
            
            // Validasi File (Pastikan nama input file di JS/HTML Bung adalah 'file_sk' atau sesuaikan di sini)
            // Saya set maksimal 10MB (10240 KB)
            'file_sk'        => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240', 
        ]);

        // 2. Proses Upload File
        if ($request->hasFile('file_sk')) {
            // File akan disimpan di folder: storage/app/public/dokumen_usulan
            $path = $request->file('file_sk')->store('dokumen_usulan', 'public');
            $validated['file_sk'] = $path; // Simpan alamat path-nya ke database
        }

        // 3. Tambahan Data Otomatis
        $validated['uploaded_at'] = now(); // Isi kolom uploaded_at dengan jam sekarang
        
        // 4. Simpan ke Database (Create)
        UsulanFile::create($validated);

        // 5. Arahkan ke route 'dashboard'
        return redirect()->route('dashboard')->with('success', 'Usulan berhasil dikirim! Data otomatis masuk riwayat.');
    }

    /**
     * API: Menampilkan riwayat file yang dikirim HARI INI
     * (Dipakai oleh Script JS untuk sidebar riwayat)
     */
    public function today()
    {
        $files = DB::table('usulan_files')
            ->whereDate('uploaded_at', now()->toDateString())
            ->orderBy('uploaded_at', 'desc')
            ->get();

        return response()->json($files);
    }
}