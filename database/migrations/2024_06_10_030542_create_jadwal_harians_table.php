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
        Schema::create('jadwal_harians', function (Blueprint $table) {
            $table->id();
            $table->time('jam_berangkat');
            $table->foreignId('rute_id')->constrained('rutes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kapal_id')->constrained('kapals')->default(21)->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('nahkoda_id')->constrained('nahkodas')->default(21)->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('jadwal_harians');
    }
};
