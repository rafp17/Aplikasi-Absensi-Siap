<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsulanController extends Controller
{
    public function index()
    {
        // Pastikan file view tetap ada di folder: resources/views/usulan/index.blade.php
        return view('usulan.index');
    }

    public function store(Request $request)
    {
        // 🔒 VALIDASI
        $request->validate([
            'jenis'    => 'required',
            'alasan'   => 'required',
            'dokumen'  => 'required',
            'dokumen.*'=> 'file|mimes:pdf,jpg,png|max:2048',
        ], [
            'dokumen.required' => 'Dokumen wajib harus diunggah.',
        ]);

        // 📂 SIMPAN DOKUMEN
        if ($request->hasFile('dokumen')) {
            foreach ($request->file('dokumen') as $file) {
                // Simpan ke storage/app/public/dokumen_usulan
                $file->store('dokumen_usulan', 'public');
            }
        }

        // 🔔 NOTIFIKASI & REDIRECT
        // Kita gunakan route('usulan.index') agar pasti kembali ke halaman utama
        return redirect()->route('usulan.index')->with(
            'success',
            'Dokumen wajib berhasil dikirim. Usulan akan diproses BKPSDM.'
        );
    }
}