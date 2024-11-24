<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class HadistController extends Controller
{
    public function getHadist(Request $request)
    {
        $response = Http::get('https://api.hadith.gading.dev/books');

        $page = $request->input('page', 1);
        $perPage = 15;
        $keyword = $request->input('keyword');

        if ($response->successful()) {
            $hadists = collect($response->json()['data']);

            if ($keyword) {
                $hadists = $hadists->filter(function ($hadist) use ($keyword) {
                    return stripos($hadist['name'], $keyword) !== false;
                });
            }

            $paginator = new LengthAwarePaginator(
                $hadists->forPage($page, $perPage),
                $hadists->count(),
                $perPage,
                $page,
                ['path' => url()->current(), 'query' => $request->query()]
            );

            return view('siswa.hadist', compact('paginator'));
        } else {
            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }
    }

    public function getHadistList($id)
    {
        $url = "https://api.hadith.gading.dev/books/{$id}?range=1-50";
        $response = Http::get($url);

        Log::info('Hadith List API Response:', $response->json());

        if ($response->successful() && isset($response['data'])) {
            $hadistList = [];
            for ($i = 1; $i <= 50; $i++) {
                $hadistList[] = ['number' => $i];
            }

            return view('siswa.hadistlist', compact('hadistList', 'id'));
        } else {
            Log::error('Failed to fetch Hadith list.', [
                'response' => $response->json(),
                'status' => $response->status(),
            ]);

            return redirect()->route('hadist')->withErrors(['error' => 'Data hadist tidak ditemukan atau gagal diambil dari API.']);
        }
    }

    public function getHadistDetails($id, $number)
    {
        $url = "https://api.hadith.gading.dev/books/{$id}/{$number}";
        $response = Http::get($url);

        if ($response->successful() && isset($response['data'])) {
            $hadist = $response['data'];
            return view('siswa.hadistdetail', compact('hadist', 'id'));
        } else {
            return redirect()->route('hadist.list', ['id' => $id])->withErrors(['error' => 'Data hadist tidak ditemukan atau gagal diambil dari API.']);
        }
    }
}