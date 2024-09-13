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
        Schema::create('informasi_muatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_pesan_jadwal_id')->constrained('detail_pesan_jadwal');
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('umur')->nullable();
            $table->string('nomor_plat')->nullable();
            $table->string('merk')->nullable();
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
        Schema::dropIfExists('informasi_muatan');
    }
};
