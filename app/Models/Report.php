<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function getTotalUsers($role)
    {
        return User::where('role', $role)->count();
    }

    public function getUsers()
    {
        return User::count();
    }
}
