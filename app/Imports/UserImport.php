<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $indexKe = 1;

        foreach ($collection as $row) {
            if ($indexKe > 1) { 
                // Ambil data dari kolom
                $data = [
                    'namaLengkap'  => $row[0] ?? '',
                    'ni'           => $row[1] ?? '',
                    'password'     => $row[2] ?? '',
                    'role'         => $row[3] ?? '',
                    'jenisKelamin' => $row[4] ?? '',
                ];

                // Validasi data
                $validator = Validator::make($data, [
                    'namaLengkap'  => 'required|string|max:255',
                    'ni'           => 'required|numeric|digits_between:4,16|unique:users,ni',
                    'password'     => 'required|min:4|max:16',
                    'role'         => 'required|string|in:siswa,guru,kepsek',
                ], [
                    'ni.digits_between' => "NIP pada baris {$indexKe} harus terdiri dari 4 hingga 16 digit.",
                    'ni.unique'         => "NIP pada baris {$indexKe} sudah terdaftar.",
                    'password.min'      => "Password pada baris {$indexKe} harus minimal 4 karakter.",
                    'password.max'      => "Password pada baris {$indexKe} tidak boleh lebih dari 16 karakter.",
                ]);

                if ($validator->fails()) {
                    // Lemparkan kesalahan jika ada
                    throw new \Exception("Kesalahan validasi pada baris {$indexKe}: " . $validator->errors()->first());
                }

                // Simpan data ke database
                User::create([
                    'namaLengkap'  => $data['namaLengkap'],
                    'ni'           => $data['ni'],
                    'password'     => Hash::make($data['password']),
                    'role'         => $data['role'],
                    'jenisKelamin' => $data['jenisKelamin'],
                ]);
            }

            $indexKe++;
        }
    }
}
