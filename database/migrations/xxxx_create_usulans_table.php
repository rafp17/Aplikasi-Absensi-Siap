<php? >

public function up()
{
    Schema::create('usulans', function (Blueprint $table) {
        $table->id();

        $table->string('jenis');
        $table->string('alasan');

        $table->string('nama_jabatan')->nullable();
        $table->string('eselon')->nullable();

        $table->date('tgl_mulai')->nullable();
        $table->date('tgl_selesai')->nullable();

        $table->string('penandatangan')->nullable();

        $table->timestamps();
    });
}






