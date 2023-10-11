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
        Schema::create('bursa_kerjas', function (Blueprint $table) {
            $table->id('id_bkk');
            $table->string('nama_sekolah');
            $table->string('email_sekolah');
            $table->string('website_sekolah');
            $table->string('instagram_sekolah');
            $table->string('facebook_sekolah');
            $table->string('telepon_sekolah');
            $table->string('alamat_sekolah');
            $table->string('foto_sekolah');
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
        Schema::dropIfExists('bkks');
    }
};
