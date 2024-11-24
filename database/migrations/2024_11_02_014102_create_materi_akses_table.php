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
            $table->bigIncrements('id_materi_akses');
            $table->unsignedBigInteger('id_materi');
            $table->string('ni', 255)->nullable();
            $table->string('status', 255);
            $table->timestamp('akses_timestamp')->nullable();
            $table->foreign('id_materi')->references('id_materi')->on('materi')->onDelete('cascade');
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
