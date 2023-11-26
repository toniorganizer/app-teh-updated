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
        Schema::create('data_kab_kotas', function (Blueprint $table) {
            $table->id();
            $table->string('id_disnaker');
            $table->string('judul');
            $table->string('type');
            $table->string('tgl_1');
            $table->string('tgl_2');
            $table->string('nmr');
            $table->string('pktl');
            $table->string('pktw');
            $table->string('jpkt');
            $table->string('lktl');
            $table->string('lktw');
            $table->string('jlkt');
            $table->string('pkdl');
            $table->string('pkdw');
            $table->string('jpkd');
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
        Schema::dropIfExists('data_kab_kotas');
    }
};
