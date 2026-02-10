<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomKatimController extends Controller
{
    /**
     * Menampilkan halaman utama Rekomendasi Ketua Tim.
     */
    public function index()
    {
        $pegawai = (object) [
            'nama' => 'Rakha Bumi, S.Kom',
            'nip'  => '190000000000000000',
            'foto' => null 
        ];

        // Sudah benar: mencari di folder rekom-katim
        return view('rekom-katim.index', compact('pegawai'));
    }

    /**
     * Menampilkan halaman Pilih Rekomendasi.
     */
    public function pilihRekom()
    {
        $pegawai = (object) [
            'nama' => 'Rakha Bumi, S.Kom',
            'nip'  => '190000000000000000',
            'foto' => null
        ];

        // PERBAIKAN DI SINI:
        // Tambahkan 'rekom-katim.' sebelum nama file
        return view('rekom-katim.pilih-rekom', compact('pegawai'));
    }
}