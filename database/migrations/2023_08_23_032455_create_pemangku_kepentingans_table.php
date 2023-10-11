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
        Schema::create('pemangku_kepentingans', function (Blueprint $table) {
            $table->id('id_pemangku_kepentingan');
            $table->string('nama_lembaga');
            $table->string('bidang_lembaga');
            $table->string('email_lembaga');
            $table->string('website_lembaga');
            $table->string('instagram_lembaga');
            $table->string('facebook_lembaga');
            $table->string('telepon_lembaga');
            $table->string('alamat_lembaga');
            $table->string('foto_lembaga');
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
        Schema::dropIfExists('pemangku_kepentingans');
    }
};
