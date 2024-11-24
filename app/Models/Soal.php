<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    
    protected $table = 'soal';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false; // Ubah ini jika ingin menggunakan timestamps

    protected $fillable = [
        'id_tugas',
        'pertanyaan',
        'pilihanA',
        'pilihanB',
        'pilihanC',
        'pilihanD',
        'jawaban',
    ];

    /**
     * Relasi ke tabel Latihansoal (Many-to-One).
     */
    public function latihansoal()
    {
        return $this->belongsTo(Latsol::class, 'id_latihan', 'id_latihan');
    }

    /**
     * Relasi ke tabel Tugas (Many-to-One).
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id_tugas');
    }

    // Metode untuk mendapatkan soal berdasarkan id_latihan
    public static function getSoalByLatihan($id_latihan)
    {
        return self::where('id_latihan', $id_latihan)->get();
    }
}
