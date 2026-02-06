<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);
        
        $mutasi = Mutasi::query('')
            ->when($search, function($query) use ($search) {
                // Pencarian mencakup kolom manual (nama_pegawai, nip) dan kolom lama
                $query->where(function($q) use ($search) {
                    $q->where('nama_pegawai', 'like', "%{$search}%")
                      ->orWhere('nip', 'like', "%{$search}%")
                      ->orWhereHas('pegawai', function($sub) use ($search) {
                          $sub->where('nama', 'like', "%{$search}%")
                              ->orWhere('nip', 'like', "%{$search}%");
                      })
                      ->orWhere('jenis_mutasi', 'like', "%{$search}%")
                      ->orWhere('instansi_tujuan', 'like', "%{$search}%")
                      ->orWhere('no_sk', 'like', "%{$search}%")
                      ->orWhere('eselon', 'like', "%{$search}%")
                      ->orWhere('tujuan_pengiriman', 'like', "%{$search}%");
                });
            })
            ->orderBy('tanggal', 'desc')
            ->paginate($perPage);
        
        return view('mutasi.index', compact('mutasi'));
    }

    /**
     * Show the form for creating a new resource.
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
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'pegawai_id' => 'nullable|exists:pegawai,id', 
            'jenis_mutasi' => 'required|in:Kenaikan Pangkat,Masuk,Pindah Antar Instansi,Keluar',
            'tanggal' => 'required|date',
            'instansi_tujuan' => 'nullable|string|max:255',
            'no_sk' => 'required|string|max:100|unique:mutasi,no_sk',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
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
        $pegawai = Pegawai::all(); 
        return view('mutasi.edit', compact('mutasi', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        $validated = $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'pegawai_id' => 'nullable|exists:pegawai,id',
            'jenis_mutasi' => 'required|in:Kenaikan Pangkat,Masuk,Pindah Antar Instansi,Keluar',
            'tanggal' => 'required|date',
            'instansi_tujuan' => 'nullable|string|max:255',
            'no_sk' => 'required|string|max:100|unique:mutasi,no_sk,' . $mutasi->id,
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'eselon' => 'nullable|string|max:50',
            'tujuan_pengiriman' => 'nullable|in:BKPSDM,BKPSDM-SEKDA,BKPSDM-SEKDA-BUPATI',
        ]);

        if ($request->hasFile('file_sk')) {
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

        return Storage::disk('public')->download($mutasi->file_sk);
    }
}