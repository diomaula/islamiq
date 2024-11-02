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
            $table->id('id_latihan');
            $table->foreignId('id_tugas')->constrained('tugas');
            $table->string('judulMateri');
            $table->string('judullatsol');
            $table->timestamps();
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
