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
        $users = User::paginate(5);
        return view('admin.user', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ni' => 'required|numeric|unique:users',
            'password' => 'required',
            'role' => 'required|in:guru,siswa,kepsek',
        ]);

        $user = User::create([
            'ni' => $request->ni,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user')->with('success', 'Data User berhasil ditambahkan.');
    }

    public function upload(Request $request)
    {
        Excel::import(new UserImport(), $request->file('file'));
    
        return redirect()->back();
        // dd($request->file('file'));
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

        return redirect()->route('user.index')->with('success', 'Data User berhasil diperbarui.');
    }


    public function destroy($ni)
    {
        $user = User::find($ni);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data User berhasil dihapus.');
    }
}
