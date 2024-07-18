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

    public function edit()
    {
        $user = auth()->user();

        $bks = Profile::find($user->ni);
        return view('profil.edit', compact('bks'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $bks = Profile::find($user->ni);
        $data = $request->validate([
            'namaLengkap' => ['nullable', 'regex:/^[^\d]+$/'],
            'tanggalLahir' => 'nullable',
            'jenisKelamin' => 'nullable',
            'image' => 'image|file|max:2024|nullable',
        ]);
        if ($request->file('image')) {
            if ($bks->image) {
                Storage::delete($bks->image);
            }
            $data['image'] = $request->file('image')->store('post-images');
        }
        $bks->update($data);
        return redirect()->route('viewProfil');
    }

    public function deleteImage(Request $request)
    {
        $user = auth()->user();

        $bks = Profile::find($user->ni);

        if ($bks->image) {
            Storage::delete($bks->image);
        }

        $bks->image = null;
        $bks->save();

        return redirect()->route('viewProfil');
    }
}