<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        return view('dokumen.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'alasan' => 'required',
        ]);

        // contoh simpan file
        if ($request->hasFile('dokumen')) {
            foreach ($request->file('dokumen') as $file) {
                $file->store('dokumen_plh', 'public');
            }
        }

        return back()->with('success', 'Usulan berhasil dikirim');
    }
}
