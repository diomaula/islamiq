<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'ni';
    protected $fillable = [
        'ni',
        'namaLengkap',
        'tanggalLahir',
        'jenisKelamin',
        'image',
    ];

    // BARU IKI
    // protected $attributes = [
    //     'namaLengkap' => '', // Atau nilai default lainnya
    //     'tanggalLahir' => '',
    //     'jenisKelamin' => '',
    // ];

    public $timestamps = false;

    public function User()
    {
        return $this->belongsTo(User::class, 'ni');
    }
}
