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
        Schema::create('data_kelompok_jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('id_disnaker');
            $table->string('judul_kj');
            $table->string('tgl_1');
            $table->string('tgl_2');
            $table->string('nmr');
            $table->text('sisa_l_kj');
            $table->text('sisa_p_kj');
            $table->text('terdaftar_l_kj');
            $table->text('terdaftar_p_kj');
            $table->text('penempatan_l_kj');
            $table->text('penempatan_p_kj');
            $table->text('hapus_l_kj');
            $table->text('hapus_p_kj');
            $table->text('akhir_l_kj');
            $table->text('akhir_p_kj');
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
        Schema::dropIfExists('data_kelompok_jabatans');
    }
};
