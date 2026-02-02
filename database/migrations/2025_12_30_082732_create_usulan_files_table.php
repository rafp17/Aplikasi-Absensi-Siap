<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usulan_files', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('alasan');
            $table->string('nama_file');
            $table->string('path_file');
            $table->timestamp('uploaded_at')->nullable();// waktu upload lengkap
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usulan_files');
    }
};
