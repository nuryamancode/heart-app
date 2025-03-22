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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('age')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('soal_2')->nullable();
            $table->integer('soal_3')->nullable();
            $table->integer('soal_4')->nullable();
            $table->integer('soal_5')->nullable();
            $table->integer('soal_6')->nullable();
            $table->integer('soal_7')->nullable();
            $table->integer('soal_8')->nullable();
            $table->integer('soal_9')->nullable();
            $table->integer('soal_10')->nullable();
            $table->integer('soal_11')->nullable();
            $table->integer('soal_12')->nullable();
            $table->integer('soal_13')->nullable();
            $table->enum('status', ['belum', 'sudah'])->default('belum');
            $table->integer('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
