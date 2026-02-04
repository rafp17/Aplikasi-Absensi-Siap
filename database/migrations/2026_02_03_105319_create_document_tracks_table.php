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
        Schema::create('document_tracks', function (Blueprint $table) {
            $table->id();
            // Pastikan nama tabel 'usulan_files' sudah benar di database Anda
            $table->foreignId('usulan_file_id')->constrained('usulan_files')->onDelete('cascade');
            $table->string('status'); 
            $table->text('keterangan');        
            $table->timestamp('tanggal')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_tracks');
    }
};