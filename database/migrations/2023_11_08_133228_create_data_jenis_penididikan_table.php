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
        Schema::create('data_jenis_penididikans', function (Blueprint $table) {
            $table->id();
            $table->string('id_disnaker');
            $table->string('tgl_1');
            $table->string('tgl_2');
            $table->string('nmr');
            $table->string('sisa_l');
            $table->string('sisa_p');
            $table->string('terdaftar_l');
            $table->string('terdaftar_p');
            $table->string('penempatan_l');
            $table->string('penempatan_p');
            $table->string('hapus_l');
            $table->string('hapus_p');
            $table->string('akhir_l');
            $table->string('akhir_p');
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
        Schema::dropIfExists('data_jenis_penididikan');
    }
};
