<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';  // Nama tabel jawaban siswa
    public $timestamps = false;  // Jika tidak ada kolom `created_at` atau `updated_at`
    protected $fillable = [
        'id_soal',    // Foreign key ke tabel soal
        'ni',         // Nomor Induk Siswa (foreign key ke users)
        'jawaban',    // Jawaban siswa untuk soal tersebut
    ];

    /**
     * Relasi ke tabel Soal (Many-to-One).
     */
    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal', 'id_soal');
    }

    /**
     * Relasi ke tabel Users (Many-to-One).
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'ni', 'ni');
    }
}
