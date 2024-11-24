<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan
    protected $table = 'tugas'; 

    // Tentukan primary key
    protected $primaryKey = 'id_tugas';

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['id_materi']; 

    // Nonaktifkan timestamps jika tidak diperlukan
    public $timestamps = false;

    // Relasi dengan Materi
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi', 'id_materi');
    }

    // Relasi dengan Latsol
    public function latsols()
    {
        return $this->hasMany(Latsol::class, 'id_tugas', 'id_tugas');
    }
}

