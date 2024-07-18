<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'ni';
    protected $fillable = [
        'ni',
        'password',
        'role',
        'namaLengkap',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'ni' => 'integer',
    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['ni'] = (int) $array['ni'];
        return $array;
    }

    public $timestamps = false;

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

    public function profil()
    {
        return $this->hasMany(Profile::class, 'ni');
    }
}
