<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatUsulan extends Model
{
    use HasFactory;

    // Paksa Laravel menggunakan tabel tanpa 's' sesuai gambar phpMyAdmin kamu
    protected $table = 'riwayat_usulan';

    protected $fillable = [
        'user_id',
        'jenis',
        'eselon',
        'tujuan_pengiriman',
        'keterangan'
    ];
}