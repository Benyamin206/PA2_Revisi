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
        Schema::create('rental_kapal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pemilik_kapal_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kapal_id')->constrained('kapals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('jenis_rental_kapal_id')->constrained('jenis_rental_kapal')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('waktu_berangkat');
            $table->string('status_pembayaran');
            $table->string('bukti_pembayaran');
            $table->bigInteger('harga');
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
        Schema::dropIfExists('rental_kapal');
    }
};
