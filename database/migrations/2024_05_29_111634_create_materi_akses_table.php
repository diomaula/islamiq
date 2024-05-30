<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materi_akses', function (Blueprint $table) {
            $table->id('id_materi_akses');
            $table->string('ni');
            $table->foreign('ni')->references('ni')->on('users');
            // $table->foreignId('id_materi')->constrained('materi');
            $table->unsignedBigInteger('id_materi'); // Foreign key column
            $table->foreign('id_materi')->references('id_materi')->on('materi')->onDelete('cascade');
            $table->string('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('materi_akses');
    }
};