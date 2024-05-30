<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';
    protected $fillable = ['id_latihan', 'ni','nilai'];

    public function latihanSoal()
    {
        return $this->belongsTo(Latsol::class, 'id_latihan');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'ni'); 
    }
}
