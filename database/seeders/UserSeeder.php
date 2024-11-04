<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'ni' => '1234',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'namaLengkap' => 'Dio Riza Maula',
                'tanggalLahir' => '2003-11-11',
                'jenisKelamin' => 'L',
                'image' => null,
            ],
            [
                'ni' => '12345',
                'password' => Hash::make('guru123'),
                'role' => 'guru',
                'namaLengkap' => 'Cindi Lestari',
                'tanggalLahir' => '2004-01-01',
                'jenisKelamin' => 'P',
                'image' => null,
            ],
            [
                'ni' => '123456',
                'password' => Hash::make('kepsek123'),
                'role' => 'kepsek',
                'namaLengkap' => 'Desi Nur Laila',
                'tanggalLahir' => '2004-01-01',
                'jenisKelamin' => 'P',
                'image' => null,
            ],
            [
                'ni' => '3622',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'namaLengkap' => 'Elina Risma',
                'tanggalLahir' => '2004-01-01',
                'jenisKelamin' => 'P',
                'image' => null,
            ],
            [
                'ni' => '5830',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'namaLengkap' => 'Deviana Reza',
                'tanggalLahir' => '2004-01-01',
                'jenisKelamin' => 'P',
                'image' => null,
            ],
        ]);
    }
}
