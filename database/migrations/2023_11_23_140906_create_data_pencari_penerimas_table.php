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
        Schema::create('data_pencari_penerimas', function (Blueprint $table) {
            $table->id();
            $table->string('id_disnaker');
            $table->string('judul');
            $table->string('tgl_1');
            $table->string('tgl_2');
            $table->string('nmr');
            $table->string('akll');
            $table->string('aklp');
            $table->string('akadl');
            $table->string('akadp');
            $table->string('akanl');
            $table->string('akanp');
            $table->string('jmll');
            $table->string('jmlp');
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
        Schema::dropIfExists('data_pencari_penerimas');
    }
};
