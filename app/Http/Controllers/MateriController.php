<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\MateriAkses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function indexGuru()
    {
        $materis = Materi::paginate(5);
        return view('guru.materi', compact('materis'));
    }

    public function indexSiswa()
    {
        $materis = Materi::paginate(5);
        return view('siswa.materi', compact('materis'));
    }

    public function indexKepsek()
    {
        $materis = Materi::paginate(5);
        return view('kepsek.materi', compact('materis'));
    }

    public function recordAccess($materiId)
    {
        // Merekam akses pengguna ke materi
        MateriAkses::updateOrCreate(
            [
                'id_materi' => $materiId,
                'ni' => auth()->user()->ni, // Ambil NIS siswa yang sedang login
            ],
            [
                'status' => 'dibaca', // Misalnya status akses
                'akses_timestamp' => now(), // Waktu akses
            ]
        );
    }

    public function create()
    {
        return view('materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulMateri' => 'required|max:255',
            'fileMateri' => 'required|mimes:pdf|max:20480', // 20MB limit
            'linkVideo' => 'nullable|url',
        ]);

        $materi = new Materi();
        $materi->judulMateri = $request->judulMateri;
        $materi->linkVideo = $request->linkVideo;

        // Upload file if exists
        if ($request->hasFile('fileMateri')) {
            $file = $request->file('fileMateri');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $materi->fileMateri = $fileName;
        }

        $materi->save();

        return redirect()->back()
            ->with('success', 'Data materi berhasil ditambahkan.');
    }

    public function showGuru($id)
    {
        $materi = Materi::findOrFail($id);
        return view('guru.materi', compact('materi'));
    }

    public function showSiswa($id)
    {
        $materi = Materi::find($id);

        // Rekam akses siswa ke materi
        $this->recordAccess($id);

        return view('siswa.materidetail', compact('materi'));
    }


    public function showKepsek($id)
    {
        $materi = Materi::find($id);
        return view('kepsek.materidetail', compact('materi'));
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judulMateri' => 'required|max:255',
            'fileMateri' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:20480', // 20MB limit
            'linkVideo' => 'nullable|url',
        ]);

        $materi = Materi::findOrFail($id);
        $materi->judulMateri = $request->judulMateri;
        $materi->linkVideo = $request->linkVideo;

        // Handle file upload
        if ($request->hasFile('fileMateri')) {
            $file = $request->file('fileMateri');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $materi->fileMateri = $fileName;
        }

        $materi->save();

        return redirect()->back()
            ->with('success', 'Data materi berhasil diperbarui.');
    }

    public function accessStatistics()
    {
        $akses = MateriAkses::select('id_materi', DB::raw('count(*) as total_akses'))
            ->groupBy('id_materi')
            ->get();

        return view('dashboard', compact('akses'));
    }


    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->fileMateri && file_exists(public_path('uploads/' . $materi->fileMateri))) {
            unlink(public_path('uploads/' . $materi->fileMateri));
        }

        $materi->delete();

        return redirect()->back()
            ->with('success', 'Data materi berhasil dihapus.');
    }

    public function getAccessData()
    {
        // Mengambil data akses materi dari database
        $aksesData = MateriAkses::select('id_materi', DB::raw('COUNT(*) as total_akses'))
            ->groupBy('id_materi')
            ->get();

        // Mengambil judul materi untuk ditampilkan di chart
        $materiTitles = Materi::whereIn('id_materi', $aksesData->pluck('id_materi'))
            ->pluck('judulMateri', 'id_materi')
            ->toArray();

        // Format data untuk chart.js
        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Total Akses',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                    'data' => []
                ]
            ]
        ];

        foreach ($aksesData as $akses) {
            $chartData['labels'][] = $materiTitles[$akses->id_materi];
            $chartData['datasets'][0]['data'][] = $akses->total_akses;
        }

        return response()->json($chartData);
    }
}
