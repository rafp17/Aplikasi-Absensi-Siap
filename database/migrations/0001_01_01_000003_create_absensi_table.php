<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->date('tanggal');
            $table->string('status'); // hadir, izin, sakit, alpha, dll
            $table->integer('jam_kerja')->nullable();
            $table->integer('menit_kerja')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
};
