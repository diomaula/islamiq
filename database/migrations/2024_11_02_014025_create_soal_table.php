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
            $table->increments('id')->primary();
            $table->unsignedBigInteger('id_tugas')->nullable();
            $table->text('pertanyaan');
            $table->string('pilihanA', 255)->nullable();
            $table->string('pilihanB', 255)->nullable();
            $table->string('pilihanC', 255)->nullable();
            $table->string('pilihanD', 255)->nullable();
            $table->string('jawaban', 255)->nullable();
            $table->decimal('bobot_nilai', 5, 2);
            $table->foreign('id_tugas')->references('id_tugas')->on('tugas')->onDelete('cascade');
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
