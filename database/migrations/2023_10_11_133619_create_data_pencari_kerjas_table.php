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
        Schema::create('data_pencari_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('pencari_kerja');
            $table->string('kelompok_umur');
            $table->integer('15_L');
            $table->integer('15_P');
            $table->integer('20_L');
            $table->integer('20_P');
            $table->integer('30_L');
            $table->integer('30_P');
            $table->integer('45_L');
            $table->integer('45_P');
            $table->integer('55_L');
            $table->integer('55_P');
            $table->integer('lowongan_L');
            $table->integer('lowongan_P');
            $table->integer('jml');
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
        Schema::dropIfExists('data_pencari_kerjas');
    }
};
