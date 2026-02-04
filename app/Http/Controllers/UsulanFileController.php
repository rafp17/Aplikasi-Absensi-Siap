<?php

namespace App\Http\Controllers;

use App\Models\UsulanFile;
use App\Models\DocumentTrack; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsulanFileController extends Controller
{
    /**
     * Menampilkan halaman form (View)
     */
    public function index()
    {
        return view('rekom-katim.index'); 
    }

    /**
     * Menampilkan Halaman Tracking Dokumen (MODE PRESENTASI)
     * Kode ini dibuat statis agar tidak perlu database untuk menampilkan alur.
     */
    public function track($id)
    {
        // Membuat objek dokumen buatan (dummy) agar tidak perlu cek database
        $dokumen = (object) [
            'id' => $id,
            'jenis' => 'Usulan PLT/PLH'
        ];

        // Daftar alur dokumen statis sesuai permintaan untuk materi presentasi
        $tracks = collect([
            (object)[
                'status' => 'Admin BKPSDM', 
                'keterangan' => 'Dokumen anda masih berada di admin BKPSDM', 
                'tanggal' => now()->subHours(5)
            ],
            (object)[
                'status' => 'SEKDA', 
                'keterangan' => 'Dokumen anda sudah di serahkan kepada SEKDA', 
                'tanggal' => now()->subHours(4)
            ],
            (object)[
                'status' => 'SEKDA', 
                'keterangan' => 'Dokumen anda sedang di lakukan pengecheck an oleh SEKDA', 
                'tanggal' => now()->subHours(3)
            ],
            (object)[
                'status' => 'SEKDA', 
                'keterangan' => 'Dokumen anda telah di acc oleh SEKDA', 
                'tanggal' => now()->subHours(2)
            ],
            (object)[
                'status' => 'BUPATI', 
                'keterangan' => 'Dokumen anda sedang di serahkan kepada BUPATI', 
                'tanggal' => now()->subHours(1)
            ],
            (object)[
                'status' => 'BUPATI', 
                'keterangan' => 'Dokumen anda sedang di lakukan pengecheck an oleh BUPATI', 
                'tanggal' => now()->subMinutes(30)
            ],
            (object)[
                'status' => 'BUPATI', 
                'keterangan' => 'Dokumen anda sudah di acc oleh BUPATI', 
                'tanggal' => now()
            ],
        ]);

        return view('tracking.index', compact('dokumen', 'tracks'));
    }

    /**
     * LOGIKA UTAMA: Menyimpan data dari Form ke Database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis'             => 'required|string',
            'alasan'            => 'nullable|string',
            'nama_jabatan'      => 'nullable|string',
            'eselon'            => 'nullable|string',
            'tujuan_pengiriman' => 'nullable|string', 
            'tgl_mulai'         => 'nullable|date',
            'tgl_selesai'       => 'nullable|date',
            'penandatangan'     => 'nullable|string',
            'file_sk'           => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240', 
        ]);

        if ($request->hasFile('file_sk')) {
            $path = $request->file('file_sk')->store('dokumen_usulan', 'public');
            $validated['file_sk'] = $path;
        }

        $validated['uploaded_at'] = now();
        
        $newFile = UsulanFile::create($validated);

        // Tetap simpan track pertama di database jika suatu saat ingin digunakan kembali
        DocumentTrack::create([
            'usulan_file_id' => $newFile->id,
            'status'         => 'Admin BKPSDM',
            'keterangan'     => 'Dokumen anda masih berada di admin BKPSDM',
            'tanggal'        => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Usulan berhasil dikirim! Posisi dokumen sekarang berada di Admin BKPSDM.');
    }

    /**
     * API: Menampilkan riwayat file yang dikirim HARI INI
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