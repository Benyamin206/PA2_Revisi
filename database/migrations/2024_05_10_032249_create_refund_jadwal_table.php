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
        Schema::create('refund_jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('pemesanan_jadwal_id');
            $table->string('alasan');
            $table->string('bank_tujuan');
            $table->string('status');
            $table->string('bukti_refund')->nullable();
            $table->string('nomor_rekening');
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
        Schema::dropIfExists('refund_jadwal');
    }
};
