<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTrack extends Model
{
    protected $fillable = ['usulan_file_id', 'status', 'keterangan', 'tanggal'];
}