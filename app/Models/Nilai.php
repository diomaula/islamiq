<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';  
    public $timestamps = false;  
    protected $fillable = [
        'id_tugas',  
        'ni',          
        'nilai',     
    ];

    public function latihansoal()
    {   
        return $this->belongsTo(Latsol::class, 'id_tugas', 'id_tugas');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'ni', 'ni');
    }

}
