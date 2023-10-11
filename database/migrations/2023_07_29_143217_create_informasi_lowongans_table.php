<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_lowongans', function (Blueprint $table) {
            $table->id('id_informasi_lowongan');
            $table->unsignedBigInteger('pemberi_informasi_id');
            $table->string('judul_lowongan');
            $table->string('salary');
            $table->string('bidang');
            $table->string('jenis_lowongan');
            $table->string('pendidikan');
            $table->string('pengalaman');
            $table->string('keterampilan');
            $table->text('deskripsi');
            $table->text('verifikasi');
            $table->date('tgl_buka');
            $table->date('tgl_tutup');
            $table->text('lokasi');
            $table->string('foto_lowongan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi_lowongans');
    }
};
