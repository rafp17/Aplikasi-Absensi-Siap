<?php

namespace App\Observers;

use App\Models\UsulanFile;
use Illuminate\Support\Facades\DB;

class UsulanFileObserver
{
    public function created(UsulanFile $usulanFile): void
    {
        if (request()->hasFile('file')) {
            foreach (request()->file('file') as $f) {
                DB::table('usulan_files')->insert([
                    'jenis'      => request('jenis'),
                    'alasan'     => request('alasan'),
                    'nama_file'  => $f->getClientOriginalName(),
                    'path_file'  => $f->store('usulan-files', 'public'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
