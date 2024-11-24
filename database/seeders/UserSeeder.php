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
                'ni' => '1000',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'namaLengkap' => 'Dio Riza Maula',
                'jenisKelamin' => 'Laki-laki',
            ],
            [
                'ni' => '2000',
                'password' => Hash::make('guru123'),
                'role' => 'guru',
                'namaLengkap' => 'Cindi Lestari',
                'jenisKelamin' => 'Perempuan',
            ],
            [
                'ni' => '3000',
                'password' => Hash::make('kepsek123'),
                'role' => 'kepsek',
                'namaLengkap' => 'Desi Nur Laila',
                'jenisKelamin' => 'Perempuan',
            ],
            [
                'ni' => '3622',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'namaLengkap' => 'Elina Risma',
                'jenisKelamin' => 'Perempuan',
            ],
            [
                'ni' => '5830',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'namaLengkap' => 'Deviana Reza',
                'jenisKelamin' => 'Perempuan',
            ],
        ]);
    }
}
