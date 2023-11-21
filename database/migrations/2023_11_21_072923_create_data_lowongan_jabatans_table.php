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
        Schema::create('data_lowongan_jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('id_disnaker');
            $table->string('judul_lj');
            $table->string('tgl_1');
            $table->string('tgl_2');
            $table->string('nmr');
            $table->text('sisa_l_lj');
            $table->text('sisa_p_lj');
            $table->text('terdaftar_l_lj');
            $table->text('terdaftar_p_lj');
            $table->text('penempatan_l_lj');
            $table->text('penempatan_p_lj');
            $table->text('hapus_l_lj');
            $table->text('hapus_p_lj');
            $table->text('akhir_l_lj');
            $table->text('akhir_p_lj');
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
        Schema::dropIfExists('data_lowongan_jabatans');
    }
};
