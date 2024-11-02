<?php

// app/Models/MateriAkses.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriAkses extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_materi_akses';

    protected $fillable = [
        'id_materi', 'ni', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ni', 'ni');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi', 'id_materi');
    }
}

