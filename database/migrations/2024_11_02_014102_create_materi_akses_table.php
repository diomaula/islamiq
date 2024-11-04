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
            $table->string('ni', 255);
            $table->string('status', 255);
            $table->timestamp('akses_timestamp');
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
