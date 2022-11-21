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
        Schema::create('kepala_keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk')->unique();
            $table->string('nama_kk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->boolean('jenis_kelamin');
            $table->string('pekerjaan');
            $table->string('alamat');
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
        Schema::dropIfExists('kepala_keluargas');
    }
};
