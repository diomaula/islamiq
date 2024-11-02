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
        Schema::create('materi_akses', function (Blueprint $table) {
            $table->id('id_materi_akses');
            $table->foreignId('id_materi')->constrained('materi');
            $table->foreignId('ni')->constrained('users');
            $table->boolean('status');
            $table->timestamp('akses_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_akses');
    }
};
