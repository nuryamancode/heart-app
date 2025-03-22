<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokter');
            $table->string('hari_awal');
            $table->string('hari_akhir')->nullable();
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->integer('sibuk')->default(0);
            $table->integer('kosong')->default(0);
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
