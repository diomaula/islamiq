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
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tugas')->constrained('tugas', 'id_tugas');
            $table->text('pertanyaan');
            $table->string('pilihanA');
            $table->string('pilihanB');
            $table->string('pilihanC');
            $table->string('pilihanD');
            $table->string('jawaban');
            $table->integer('bobot_nilai');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
