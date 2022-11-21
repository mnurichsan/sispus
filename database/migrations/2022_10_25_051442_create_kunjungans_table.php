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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk');
            $table->time('jam_masuk');
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('poli_id');
            $table->unsignedBigInteger('dokter_id');
            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('pasiens');
            $table->foreign('poli_id')->references('id')->on('polis');
            $table->foreign('dokter_id')->references('id')->on('dokters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunjungans');
    }
};
