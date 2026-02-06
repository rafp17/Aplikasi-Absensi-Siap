<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mutasi', function (Blueprint $table) {
            // Menambah kolom nama_pegawai dan nip setelah kolom id
            $table->string('nama_pegawai')->after('id')->nullable();
            $table->string('nip')->after('nama_pegawai')->nullable();
            
            // Mengubah pegawai_id menjadi nullable agar tidak error saat input manual
            $table->unsignedBigInteger('pegawai_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->dropColumn(['nama_pegawai', 'nip']);
            $table->unsignedBigInteger('pegawai_id')->nullable(false)->change();
        });
    }
};