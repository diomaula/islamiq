<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $title = "Admin || User";
        $users = User::paginate(5);
        return view('admin.user', compact('users'));
    }

    // public function create()
    // {
    //     return view('user.create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'ni' => 'required|numeric|unique:users',
            'namaLengkap' => ['required', 'regex:/^[\pL\s]+$/u'],
            'password' => 'required',
            'role' => 'required|in:guru,siswa,kepsek',
        ], [
            'namaLengkap.regex' => 'Nama tidak boleh angka.',
            'ni.numeric' => 'Nomor Induk harus berupa angka.',
            'ni.unique' => 'Nomor Induk sudah terdaftar.',
    
        ]);        

        $user = User::create([
            'ni' => $request->ni,
            'namaLengkap' => $request->namaLengkap,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Data User berhasil ditambahkan.');
    }

    public function upload(Request $request)
    {
        // Validasi file harus berupa Excel (.xlsx atau .xls)
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ], [
            'file.mimes' => 'File harus berupa format Excel (.xlsx atau .xls).'
        ]);
    
        // Jika file valid, lakukan proses import
        Excel::import(new UserImport(), $request->file('file'));
    
        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data User berhasil ditambahkan.');
    }
    

    public function show($ni)
    {
        $user = User::find($ni);

        // $isGuru = $user->isGuru();

        return view('user.show', compact('user'));
    }



    public function edit($ni)
    {
        $user = User::find($ni);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $ni)
    {
        $request->validate([
            'ni' => 'required|numeric',
            'password' => 'required',
            'role' => 'required|in:guru,siswa,kepsek',
        ]);

        $user = User::find($ni);

        $user->update([
            'ni' => $request->ni,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Data User berhasil diperbarui.');
    }


    public function destroy($ni)
    {
        $user = User::find($ni);
        $user->delete();
        return redirect()->back()->with('success', 'Data User berhasil dihapus.');
    }
}
