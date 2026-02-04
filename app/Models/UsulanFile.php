<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanFile extends Model
{
    use HasFactory;

    // 1. Definisikan nama tabelnya
    protected $table = 'usulan_files'; 

    // 2. Daftarkan semua nama kolom formulir di sini
    protected $fillable = [
        'jenis',
        'alasan',
        'nama_jabatan',
        'eselon',
        'tgl_mulai',
        'tgl_selesai',
        'penandatangan',
        'file_sk',
        'status', 
        'created_by',
        'tujuan_pengiriman', 
    ];

    /**
     * Relasi ke DocumentTrack (Satu dokumen memiliki banyak riwayat tracking)
     */
    public function tracks()
    {
        // Menghubungkan ke Model DocumentTrack menggunakan foreign key 'usulan_file_id'
        // Data diurutkan dari yang paling lama ke yang terbaru
        return $this->hasMany(DocumentTrack::class, 'usulan_file_id')->orderBy('tanggal', 'asc');
    }
}