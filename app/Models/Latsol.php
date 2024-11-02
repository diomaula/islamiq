<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latsol extends Model
{
    use HasFactory;
    
    // Konfigurasi tabel dan primary key
    protected $table = 'latihansoal';
    protected $primaryKey = 'id_latihan';
    public $incrementing = true;
    public $timestamps = false;

    // Field yang bisa diisi melalui mass-assignment
    protected $fillable = [
        'id_tugas',
        'id_materi',
        'judulMateri',
        'judulLatsol',
    ];

    /**
     * Relasi ke tabel Tugas (Many-to-One).
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id_tugas');
    }

    /**
     * Relasi ke tabel Soal (One-to-Many).
     */
    public function soal()
    {
        return $this->hasMany(Soal::class, 'id_latihan', 'id_latihan');
    }

    /**
     * Relasi ke tabel Nilai (One-to-Many).
     */
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_latihan', 'id_latihan');
    }
}
