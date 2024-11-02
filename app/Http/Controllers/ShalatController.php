<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ShalatController extends Controller
{
    public function getWaktuShalat(Request $request)
    {
        // Konfigurasi API
        $city = 'Banyuwangi';
        $country = 'Indonesia';
        $method = 4; // Muslim World League pilihan yang cocok
        $apiUrl = "https://api.aladhan.com/v1/timingsByCity?city=$city&country=$country&method=$method";

        // Mengambil data dari API menggunakan HTTP Client Laravel
        $response = Http::get($apiUrl);

        // Memeriksa respone jika berhasil
        if ($response->successful()) {
            // Ambil data waktu shalat dari JSON API
            $data = $response->json();
            $timings = $data['data']['timings'];
            $date = $data['data']['date']['readable'];

            // Ambil waktu sekarang
            $now = Carbon::now()->format('H:i');

            // Kirim waktu sekarang ke view
            return view('siswa.dashboard', compact('timings', 'date', 'now'));
        } else {
            // Jika API gagal diakses, kirimkan pesan error
            return response()->json(['error' => 'Gagal mengambil data dari API'], 500);
        }
    }
}