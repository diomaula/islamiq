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
        Schema::create('latihansoal', function (Blueprint $table) {
            $table->bigIncrements('id_latihan')->primary();
            $table->unsignedBigInteger('id_tugas');
            $table->string('judulMateri', 255);
            $table->string('judulLatsol', 255);
            $table->foreign('id_tugas')->references('id_tugas')->on('tugas')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihansoal');
    }
};
