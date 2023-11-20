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
        Schema::create('data_lowongan_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('id_disnaker');
            $table->string('judul_lp');
            $table->string('tgl_1');
            $table->string('tgl_2');
            $table->string('nmr');
            $table->string('sisa_l_lp');
            $table->string('sisa_p_lp');
            $table->string('terdaftar_l_lp');
            $table->string('terdaftar_p_lp');
            $table->string('penempatan_l_lp');
            $table->string('penempatan_p_lp');
            $table->string('hapus_l_lp');
            $table->string('hapus_p_lp');
            $table->string('akhir_l_lp');
            $table->string('akhir_p_lp');
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
        Schema::dropIfExists('data_lowongan_pendidikans');
    }
};
