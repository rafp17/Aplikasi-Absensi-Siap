<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatUsulan;
use Illuminate\Support\Facades\Auth;

class PltplhController extends Controller
{
    public function pltPlhIndex()
    {
        return view('plt.index');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI (Disesuaikan dengan atribut 'name' di file index.blade.php kamu)
        $request->validate([
            'jenis'             => 'required',
            'alasan'            => 'required',
            'tujuan_pengiriman' => 'required', 
            'dokumen'           => 'required',
        ], [
            'tujuan_pengiriman.required' => 'Tujuan pengiriman wajib dipilih.',
            'dokumen.required'           => 'Dokumen usulan wajib diunggah.',
        ]);

        // 2. SIMPAN FILE FISIK
        if ($request->hasFile('dokumen')) {
            foreach ($request->file('dokumen') as $file) {
                $file->store('dokumen_usulan', 'public');
            }
        }

        // 3. SIMPAN KE DATABASE (Agar angka Dashboard otomatis bertambah)
        RiwayatUsulan::create([
            'user_id'           => Auth::id() ?? 1,
            'jenis'             => $request->jenis,
            'eselon'            => $request->eselon ?? '-',
            'tujuan_pengiriman' => $request->tujuan_pengiriman,
            'keterangan'        => 'Usulan ' . $request->jenis . ' berhasil dikirim ke ' . $request->tujuan_pengiriman,
        ]);

        // 4. REDIRECT PAKSA KE DASHBOARD (Halaman Utama)
        return redirect('/')->with('success', 'Usulan Berhasil Dikirim!');
    }
}