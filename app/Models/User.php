<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'ni';
    public $incrementing = false; // Agar Laravel tahu bahwa 'ni' bukan auto-increment
    protected $keyType = 'string'; // Jika 'ni' adalah string, sesuaikan tipe datanya

    protected $fillable = [
        'ni',
        'password',
        'role',
        'namaLengkap',
        'tanggalLahir',
        'jenisKelamin',
        'kelas',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public $timestamps = false;

    // Override toArray jika perlu mengubah casting 'ni' menjadi integer
    public function toArray()
    {
        $array = parent::toArray();
        $array['ni'] = (int) $array['ni'];
        return $array;
    }

    // Method untuk menentukan apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isGuru()
    {
        return $this->role === 'guru';
    }

    public function isKepsek()
    {
        return $this->role === 'kepsek';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    // Relasi ke profil (bisa diubah ke relasi lain jika perlu)
    public function profil()
    {
        return $this->hasMany(Profile::class, 'ni', 'ni'); // Misalkan ada tabel 'profil'
    }

    // Relasi ke tabel nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'ni', 'ni');
    }

    // Relasi ke tabel materi akses
    public function materiAkses()
    {
        return $this->hasMany(MateriAkses::class, 'ni', 'ni');
    }
}
