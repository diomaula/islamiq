<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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

    public function store(Request $request)
    {
        $request->validate([
            'ni' => 'required|numeric|digits_between:4,16|unique:users',
            'namaLengkap' => ['required', 'regex:/^[\pL\s]+$/u'],
            'password' => 'required|min:4|max:16', 
            'role' => 'required|in:guru,siswa,kepsek',
            // 'tanggalLahir' => 'required|date', 
            'jenisKelamin' => 'required|in:Laki-Laki,Perempuan', 
        ], [
            'namaLengkap.regex' => 'Nama tidak boleh angka.',
            'ni.numeric' => 'Nomor Induk harus berupa angka.',
            'ni.unique' => 'Nomor Induk sudah terdaftar.',
            'ni.digits_between' => 'Nomor Induk harus terdiri 4-16 angka.',
            'password.min' => 'Password harus terdiri 4-16 karakter.',
            'password.max' => 'Password harus terdiri 4-16 karakter.',
            // 'tanggalLahir.required' => 'Tanggal Lahir harus diisi.',
            // 'tanggalLahir.date' => 'Tanggal Lahir harus berupa tanggal yang valid.',
            'jenisKelamin.required' => 'Jenis Kelamin harus dipilih.',
            'jenisKelamin.in' => 'Jenis Kelamin harus Laki-Laki atau Perempuan.',
        ]);
    
        $user = User::create([
            'ni' => $request->ni,
            'namaLengkap' => $request->namaLengkap,
            'password' => bcrypt($request->password), // Encrypting the password 
            'role' => $request->role,
            // 'tanggalLahir' => $request->tanggalLahir,
            'jenisKelamin' => $request->jenisKelamin,
        ]);
    
        return redirect()->back()->with('success', 'Data User berhasil ditambahkan.');
    }
    

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ], [
            'file.mimes' => 'File harus berupa format Excel (.xlsx atau .xls).'
        ]);

        try {
            Excel::import(new UserImport(), $request->file('file'));
            return redirect()->back()->with('success', 'Data User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
            'ni' => 'required|numeric|digits_between:4,16|unique:users,ni,' . $ni . ',ni',
            'namaLengkap' => 'required',
            'role' => 'required|in:guru,siswa,kepsek',
            'jenisKelamin' => 'required|in:Laki-Laki,Perempuan', 
        ], [
            'ni.numeric' => 'Nomor Induk harus berupa angka.',
            'ni.unique' => 'Nomor Induk sudah terdaftar.',
            'ni.digits_between' => 'Nomor Induk harus terdiri dari 4-16 angka.',
        ]);

        try {
            $user = User::findOrFail($ni);

            $dataToUpdate = [
                'ni' => $request->ni,
                'namaLengkap' => $request->namaLengkap,
                'role' => $request->role,
                'jenisKelamin' => $request->jenisKelamin,
            ];

            $user->update($dataToUpdate);

            return redirect()->back()->with('success', 'Data User berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data!']);
        }
    }




    public function destroy($ni)
    {
        $user = User::find($ni);
        $user->delete();
        return redirect()->back()->with('success', 'Data User berhasil dihapus.');
    }
}
