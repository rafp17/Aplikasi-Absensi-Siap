<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting: Tambahkan ini agar fungsi delete/download tidak error

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);
        
        $mutasi = Mutasi::with('pegawai')
            ->when($search, function($query) use ($search) {
                $query->whereHas('pegawai', function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })
                ->orWhere('jenis_mutasi', 'like', "%{$search}%")
                ->orWhere('instansi_tujuan', 'like', "%{$search}%")
                ->orWhere('no_sk', 'like', "%{$search}%")
                // --- TAMBAHAN BARU: Agar bisa dicari berdasarkan eselon & tujuan pengiriman ---
                ->orWhere('eselon', 'like', "%{$search}%")
                ->orWhere('tujuan_pengiriman', 'like', "%{$search}%");
            })
            ->orderBy('tanggal', 'desc')
            ->paginate($perPage);
        
        return view('mutasi.index', compact('mutasi'));
    }

    /**
     * Show the form for creating a new resource.
     * (Tambahkan function ini jika belum ada, untuk membuka halaman create)
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('mutasi.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id', // pastikan nama tabel di db 'pegawai' atau 'pegawais'
            'jenis_mutasi' => 'required|in:Kenaikan Pangkat,Masuk,Pindah Antar Instansi,Keluar',
            'tanggal' => 'required|date',
            'instansi_tujuan' => 'nullable|string|max:255',
            'no_sk' => 'required|string|max:100|unique:mutasi,no_sk',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            
            // --- TAMBAHAN BARU: Validasi kolom baru ---
            'eselon' => 'nullable|string|max:50', 
            'tujuan_pengiriman' => 'nullable|in:BKPSDM,BKPSDM-SEKDA,BKPSDM-SEKDA-BUPATI', 
        ]);

        if ($request->hasFile('file_sk')) {
            $path = $request->file('file_sk')->store('sk_mutasi', 'public');
            $validated['file_sk'] = $path;
        }

        Mutasi::create($validated);

        return redirect()->route('mutasi.index')
            ->with('success', 'Data mutasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mutasi $mutasi)
    {
        // Mengambil data pegawai untuk dropdown
        $pegawai = Pegawai::all(); 
        return view('mutasi.edit', compact('mutasi', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'jenis_mutasi' => 'required|in:Kenaikan Pangkat,Masuk,Pindah Antar Instansi,Keluar',
            'tanggal' => 'required|date',
            'instansi_tujuan' => 'nullable|string|max:255',
            'no_sk' => 'required|string|max:100|unique:mutasi,no_sk,' . $mutasi->id,
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:2048',

            // --- TAMBAHAN BARU: Validasi update kolom baru ---
            'eselon' => 'nullable|string|max:50',
            'tujuan_pengiriman' => 'nullable|in:BKPSDM,BKPSDM-SEKDA,BKPSDM-SEKDA-BUPATI',
        ]);

        if ($request->hasFile('file_sk')) {
            // Hapus file lama jika ada
            if ($mutasi->file_sk) {
                Storage::disk('public')->delete($mutasi->file_sk);
            }
            
            $path = $request->file('file_sk')->store('sk_mutasi', 'public');
            $validated['file_sk'] = $path;
        }

        $mutasi->update($validated);

        return redirect()->route('mutasi.index')
            ->with('success', 'Data mutasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mutasi $mutasi)
    {
        if ($mutasi->file_sk) {
            Storage::disk('public')->delete($mutasi->file_sk);
        }
        
        $mutasi->delete();

        return redirect()->route('mutasi.index')
            ->with('success', 'Data mutasi berhasil dihapus.');
    }

    /**
     * Download SK file
     */
    public function downloadSk(Mutasi $mutasi)
    {
        if (!$mutasi->file_sk) {
            return redirect()->back()->with('error', 'File SK tidak ditemukan.');
        }

        // Pastikan facade Storage sudah di-import di paling atas
        return Storage::disk('public')->download($mutasi->file_sk);
    }
}