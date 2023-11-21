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
        Schema::create('data_golongan_usahas', function (Blueprint $table) {
            $table->id();
            $table->string('id_disnaker');
            $table->string('judul_gu');
            $table->string('tgl_1');
            $table->string('tgl_2');
            $table->string('nmr');
            $table->text('sisa_l_gu');
            $table->text('sisa_p_gu');
            $table->text('terdaftar_l_gu');
            $table->text('terdaftar_p_gu');
            $table->text('penempatan_l_gu');
            $table->text('penempatan_p_gu');
            $table->text('hapus_l_gu');
            $table->text('hapus_p_gu');
            $table->text('akhir_l_gu');
            $table->text('akhir_p_gu');
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
        Schema::dropIfExists('data_golongan_usahas');
    }
};
