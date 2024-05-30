<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('latihansoal', function (Blueprint $table) {
            $table->id('id_latihan');
            // $table->foreignId('id_tugas')->constrained('tugas');
            $table->unsignedBigInteger('id_tugas'); // Foreign key column
            $table->foreign('id_tugas')->references('id_tugas')->on('tugas')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->string('pilihanA');
            $table->string('pilihanB');
            $table->string('pilihanC');
            $table->string('pilihanD');
            $table->string('jawaban');
            $table->integer('urutan_soal');
            $table->integer('bobot_nilai');
        });
    }

    public function down()
    {
        Schema::dropIfExists('latihansoal');
    }

};