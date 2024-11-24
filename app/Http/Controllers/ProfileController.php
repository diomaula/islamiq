<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profil()
    {
        $user = auth()->user();

        $bks = Profile::find($user->ni);
        return view('profil.profil', compact('bks'));
    }

    
}