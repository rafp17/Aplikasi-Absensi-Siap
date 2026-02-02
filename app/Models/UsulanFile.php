<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini (opsional tapi bagus)
use Illuminate\Database\Eloquent\Model;

class UsulanFile extends Model
{
    use HasFactory;

    // 1. Definisikan nama tabelnya (agar tidak salah sambung)
    // Pastikan nama tabel di database Bung adalah 'usulan_files'
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
        'file_sk', // atau 'file_path', sesuaikan dengan nama kolom file di database Bung
        'status',  // jika ada kolom status
        'created_by', // jika ada pencatatan siapa yang upload
        
        // --- KOLOM BARU ---
        'tujuan_pengiriman', 
    ];
}