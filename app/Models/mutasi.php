<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasi';
    
    protected $fillable = [
        'pegawai_id',
        'jenis_mutasi',
        'tanggal',
        'instansi_tujuan',
        'no_sk',
        'file_sk',
        'created_at',
        'updated_at',
        'eselon',
        'tujuan_pengiriman'
    ];

    protected $dates = ['tanggal'];

    // Relationship dengan model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}