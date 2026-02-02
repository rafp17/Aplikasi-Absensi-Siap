<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // TAMBAHAN: Cek dulu apakah kolomnya sudah ada atau belum
        // Jika kolom 'uploaded_at' TIDAK ADA (!), baru jalankan perintah tambah
        if (!Schema::hasColumn('usulan_files', 'uploaded_at')) {
            Schema::table('usulan_files', function (Blueprint $table) {
                $table->timestamp('uploaded_at')->nullable()->after('path_file');
            });
        }
    }

    public function down()
    {
        // Cek dulu kalau kolomnya ada, baru hapus
        if (Schema::hasColumn('usulan_files', 'uploaded_at')) {
            Schema::table('usulan_files', function (Blueprint $table) {
                $table->dropColumn('uploaded_at');
            });
        }
    }
};
