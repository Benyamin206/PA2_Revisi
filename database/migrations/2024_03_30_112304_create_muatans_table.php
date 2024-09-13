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
        Schema::create('muatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_muatan_id')->constrained('jenis_muatan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama');
            $table->integer('harga_per_item');
            $table->integer('maksimal');
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });
    }
    // 2024_03_30_112302_create_muatans_table.php
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('muatans');
    }
};
