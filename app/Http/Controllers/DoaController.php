<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class DoaController extends Controller
{
    public function getDoa(Request $request)
    {
        $response = Http::get('https://equran.id/api/doa');

        $page = $request->input('page', 1);
        $perPage = 6;
        $keyword = $request->input('keyword');

        if ($response->successful()) {
            $doas = collect($response->json());
            if ($keyword) {
                $doas = $doas->filter(function ($doa) use ($keyword) {
                    return stripos($doa['nama'], $keyword) !== false;
                });
            }
            $paginator = new LengthAwarePaginator(
                $doas->forPage($page, $perPage),
                $doas->count(),
                $perPage,
                $page,
                ['path' => url()->current(), 'query' => $request->query()]
            );

            return view('siswa.doa', compact('paginator'));
        } else {
            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }
    }

    public function getDoaDetail($id)
    {
        $response = Http::get("https://equran.id/api/doa/$id");

        if ($response->successful()) {
            $doa = $response->json();

            return view('siswa.doadetail', compact('doa'));
        } else {
            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }
    }
}