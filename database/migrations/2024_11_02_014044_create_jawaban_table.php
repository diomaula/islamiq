<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_soal');
            $table->unsignedBigInteger('ni')->nullable();
            $table->string('jawaban_siswa', 255)->nullable();
            $table->foreign('id_soal')->references('id')->on('soal')->onDelete('cascade');
            $table->foreign('ni')->references('ni')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};
