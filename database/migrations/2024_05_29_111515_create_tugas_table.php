<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->unsignedBigInteger('id_materi'); // Foreign key column

            // Set the foreign key constraint
            $table->foreign('id_materi')->references('id_materi')->on('materi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tugas');
    }
};