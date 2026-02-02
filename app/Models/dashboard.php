<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'nip',
        'tanggal',
        'status',
        'jam_kerja',
        'menit_kerja'
    ];
}
