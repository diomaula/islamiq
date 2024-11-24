<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'ni' => 'required|numeric',
            'password' => 'required',
        ]);

        $data = $request->only('ni', 'password');

        if (Auth::attempt($data)) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('dashboardadmin');
            } elseif (auth()->user()->isGuru()) {
                return redirect()->route('dashboardguru');
            } elseif (auth()->user()->isKepsek()) {
                return redirect()->route('dashboardkepsek');
            } elseif (auth()->user()->isSiswa()) {
                return redirect()->route('dashboardsiswa');
            } else {
                return back()->with('error', 'Akses ditolak. Anda tidak memiliki izin yang cukup.');
            }
        } else {
            return back()->with('error', 'nomor induk atau password salah!');
        }
    }

    public function ubahPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'passwordLama' => 'required',
            'passwordBaru' => 'required|string|min:4|max:16|confirmed', // 'confirmed' untuk validasi dengan repeatPassword
        ], [
            'passwordLama.required' => 'Password lama wajib diisi.',
            'passwordBaru.required' => 'Password baru wajib diisi.',
            'passwordBaru.min' => 'Password harus terdiri 4-16 karakter.',
            'passwordBaru.max' => 'Password harus terdiri 4-16 karakter.',
            'passwordBaru.confirmed' => 'Password baru dan konfirmasi password tidak sama.',
        ]);

        // Periksa apakah password lama cocok
        if (!Hash::check($request->passwordLama, auth()->user()->password)) {
            return back()->with('error', 'Password lama tidak sesuai!');
        }

        // Update password
        auth()->user()->update([
            'password' => Hash::make($request->passwordBaru),
        ]);

        return redirect()->route('viewProfil')->with('success', 'Password berhasil diubah!');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah berhasil logout!');
    }
}
