<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    protected $fillable = ['judulMateri', 'fileMateri', 'linkVideo']; // Added 'linkVideo' to fillable
    public $timestamps = false;

    public function tugas()
    {
        return $this->belongsToMany(Tugas::class);
    }
}