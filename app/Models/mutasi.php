<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasi';
    
    protected $fillable = [
        'nama_pegawai',      // Input manual
        'nip',               // Input manual
        'pegawai_id',        // Kosongkan saja jika input manual
        'jenis_mutasi',
        'tanggal',
        'instansi_tujuan',
        'no_sk',
        'file_sk',
        'eselon',
        'tujuan_pengiriman',
        'created_at',
        'updated_at',
    ];

    /**
     * Casting format tanggal agar otomatis menjadi objek Carbon
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi Pegawai dihapus karena model 'Pegawai' tidak ditemukan 
     * di folder Models Anda. Data sekarang murni diambil dari 
     * kolom 'nama_pegawai' dan 'nip' di tabel mutasi ini sendiri.
     */
}