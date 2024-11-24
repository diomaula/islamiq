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
        $method = 4;
        $apiUrl = "https://api.aladhan.com/v1/timingsByCity?city=$city&country=$country&method=$method";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $data = $response->json();
            $timings = $data['data']['timings'];
            $date = $data['data']['date']['readable'];

            $now = Carbon::now()->format('H:i');

            return view('siswa.dashboard', compact('timings', 'date', 'now'));
        } else {
            return response()->json(['error' => 'Gagal mengambil data dari API'], 500);
        }
    }
}