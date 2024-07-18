<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            // Cek peran setelah berhasil login
            if (auth()->user()->isAdmin()) {
                // Jika peran adalah 'guru', redirect ke halaman home
                return redirect()->route('dashboardadmin');
            } elseif (auth()->user()->isGuru()) {
                // Jika peran adalah 'kepsek', redirect ke halaman home
                return redirect()->route('dashboardguru');
            } elseif (auth()->user()->isKepsek()) {
                // Jika peran adalah 'kepsek', redirect ke halaman home
                return redirect()->route('dashboardkepsek');
            } elseif (auth()->user()->isSiswa()) {
                // Jika peran adalah 'kepsek', redirect ke halaman home
                return redirect()->route('siswa.materi.index');
            } else {
                // Jika peran bukan 'guru' atau 'kepsek', akan ditampilkan pesan error
                return back()->with('error', 'Akses ditolak. Anda tidak memiliki izin yang cukup.');
            }
        } else {
            return back()->with('error', 'nomor induk atau password salah!');
        }

        // dd($data);
    }

    public function ubahPassword(Request $request)
    {
        if (!Hash::check($request->passwordLama, auth()->user()->password)) {
            return back()->with('error', 'password lama tidak sesuai!');
        }

        if ($request->passwordBaru != $request->repeatPassword) {
            return back()->with('error', 'password baru tidak sama!');
        }
        auth()->user()->update([
            'password' => Hash::make($request->passwordBaru),
        ]);
        return redirect()->route('viewProfil');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // public function updatePass()
    // {
    //     $user = auth()->user();

    //     $bks = User::find($user->ni);
    //     return view('auth.password', compact('bks'));
    // }

    // public function ubahPassword(Request $request)
    // {
    //     if (!Hash::check($request->passwordLama, auth()->user()->password)) {
    //         return back()->with('error', 'password lama tidak sesuai!');
    //     }

    //     if ($request->passwordBaru != $request->repeatPassword) {
    //         return back()->with('error', 'password baru tidak sama!');
    //     }
    //     auth()->user()->update([
    //         'password' => Hash::make($request->passwordBaru),
    //     ]);
    //     return redirect()->route('viewProfil');
    // }
}
