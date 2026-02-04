<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatUsulan;
use App\Models\Pegawai; // Tambahkan ini agar pemanggilan model rapi
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PltplhController extends Controller
{
    public function pltPlhIndex()
    {
        return view('plt.index');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI (Ditambah validasi mimes untuk keamanan)
        $request->validate([
            'jenis'             => 'required',
            'alasan'            => 'required',
            'tujuan_pengiriman' => 'required',
            'dokumen'           => 'required|file|mimes:pdf,jpg,png,docx|max:2048', // Batas 2MB
        ], [
            'tujuan_pengiriman.required' => 'Tujuan pengiriman wajib dipilih.',
            'dokumen.required'           => 'Dokumen usulan wajib diunggah.',
            'dokumen.mimes'              => 'Format dokumen harus PDF, JPG, PNG, atau DOCX.',
        ]);

        // 2. SIMPAN FILE FISIK & AMBIL NAMANYA
        $namaFile = null;
        if ($request->hasFile('dokumen')) {
            // Kita ambil satu file saja sesuai kebutuhan database biasanya
            $file = $request->file('dokumen');
            $namaFile = $file->store('dokumen_usulan', 'public');
        }

        // 3. SIMPAN KE DATABASE
        RiwayatUsulan::create([
            'user_id'           => Auth::id() ?? 1,
            'jenis'             => $request->jenis,
            'eselon'            => $request->eselon ?? '-',
            'tujuan_pengiriman' => $request->tujuan_pengiriman,
            'dokumen'           => $namaFile, // Simpan path file ke kolom 'dokumen'
            'keterangan'        => 'Usulan ' . $request->jenis . ' berhasil dikirim ke ' . $request->tujuan_pengiriman,
        ]);

        return redirect()->route('dashboard')->with('success', 'Usulan Berhasil Dikirim!');
    }

    public function showProfile($id)
    {
        // Menggunakan Model yang sudah di-import di atas
        $pegawai = User::find($id);

        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan');
        }

        return view('pages.profile', compact('pegawai'));
    }
}