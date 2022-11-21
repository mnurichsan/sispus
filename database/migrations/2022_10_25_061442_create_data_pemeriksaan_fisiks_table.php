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
        Schema::create('data_pemeriksaan_fisiks', function (Blueprint $table) {
            $table->id();
            $table->string('ruangan');
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('tekanan_darah');
            $table->string('pernafasan');
            $table->string('nadi');
            $table->string('suhu');
            $table->string('keterangan')->nullable();
            
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
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
        Schema::dropIfExists('data_pemeriksaan_fisiks');
    }
};
