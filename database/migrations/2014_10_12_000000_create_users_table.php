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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('ni')->primary();
            $table->string('password', 255);
            $table->enum('role', ['guru', 'siswa', 'kepsek', 'admin']);
            $table->string('namaLengkap', 100);
            $table->date('tanggalLahir');
            $table->string('jenisKelamin', 10);
            $table->string('image', 200)->nullable();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
