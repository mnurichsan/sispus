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
        Schema::create('kajian_medis', function (Blueprint $table) {
            $table->id();
            $table->string('diagnosa');
            $table->string('terapi');
            $table->string('catatan')->nullable();
            $table->unsignedBigInteger('kunjungan_id');
            $table->unsignedBigInteger('pasien_id');
            $table->timestamps();

            $table->foreign('kunjungan_id')->references('id')->on('kunjungans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kajian_medis');
    }
};
