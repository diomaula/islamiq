<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latsol extends Model
{
    use HasFactory;
    protected $table = 'latihansoal';
    protected $primaryKey = 'id_latihan';
    protected $fillable = [
        'id_tugas',
        'id_materi',
        'judulMateri',
        'judulLatsol',
        'pertanyaan',
        'bobot_nilai',
        'pilihanA',
        'pilihanB',
        'pilihanC',
        'pilihanD',
        'jawaban',
        'urutan_soal',
    ];

    public $timestamps = false;

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id_tugas');
    }
}