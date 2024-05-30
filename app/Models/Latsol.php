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
        'id_latihan',
        'id_materi',
        'judulMateri',
        'isiLatihanSoal',
        'nilai',
        'pilihan1',
        'pilihan2',
        'pilihan3',
        'pilihan4',
        'jawaban',
    ];

    public $timestamps = false;

    // Fungsi untuk relasi materi dengan latihan soal --> one to many
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }
}
