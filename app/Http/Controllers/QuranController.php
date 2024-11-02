<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class QuranController extends Controller
{
    public function getSurat(Request $request)
    {
        $response = Http::get('https://equran.id/api/v2/surat');

        if ($response->successful()) {
            $surat = $response->json();

            $suratsArray = $surat['data'];
            $page = $request->input('page', 1);
            $perPage = 10;
            $keyword = $request->input('keyword');

            $surats = collect($suratsArray);

            if ($keyword) {
                $surats = $surats->filter(function ($surat) use ($keyword) {
                    // Ubah pencarian menjadi case insensitive
                    return stripos($surat['namaLatin'], $keyword) !== false;
                });
            }
            $paginator = new LengthAwarePaginator(
                $surats->forPage($page, $perPage),
                $surats->count(),
                $perPage,
                $page,
                ['path' => url()->current(), 'query' => $request->query()]
            );
            return view('siswa.surah', compact('paginator'));
        } else {
            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }
    }

    public function getSuratDetail($nomor)
    {
        $response = Http::get("https://equran.id/api/v2/surat/$nomor");

        if ($response->successful()) {
            $suratDetail = $response->json();
            return view('siswa.surahdetail', ['surat' => $suratDetail['data']]);
        } else {
            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }
    }
}