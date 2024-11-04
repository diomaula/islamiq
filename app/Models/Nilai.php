<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';  // Nama tabel
    public $timestamps = false;  // Jika tidak ada kolom `created_at` atau `updated_at`
    protected $fillable = [
        'id_tugas',  // Foreign key ke tabel latihansoal
        'ni',          // Nomor Induk Siswa (foreign key ke users)
        'nilai',       // Nilai akhir siswa
    ];

    /**
     * Relasi ke tabel Latihansoal (Many-to-One).
     */
    public function latihansoal()
{
    return $this->belongsTo(Latsol::class, 'id_tugas', 'id_tugas');
}

    /**
     * Relasi ke tabel Users (Many-to-One).
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'ni', 'ni');
    }

    public function latsol()
{
    return $this->belongsTo(Latsol::class, 'id_tugas', 'id_tugas');
}

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function latsol()
    // {
    //     return $this->belongsTo(Latsol::class); // atau jenis hubungan lain yang sesuai
    // }

}
