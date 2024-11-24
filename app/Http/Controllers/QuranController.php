<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

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
                $keyword = strtolower($keyword);

                $surats = $surats->filter(function ($surat) use ($keyword) {
                    $namaLatin = strtolower($surat['namaLatin']);

                    // Buang awalan seperti "Al-", "An-", dan lainnya untuk pencarian awalan
                    $namaNormalized = preg_replace('/^(al|an|ar|as|at|az|ad|ash|asy)[-]*/i', '', $namaLatin);

                    // Cocokkan dengan awalan keyword
                    return Str::startsWith($namaLatin, $keyword) || Str::startsWith($namaNormalized, $keyword);
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