<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->bigIncrements('id_tugas');
            $table->unsignedBigInteger('id_materi')->nullable();
            $table->foreign('id_materi')->references('id_materi')->on('materi')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('tugas');
    }
};