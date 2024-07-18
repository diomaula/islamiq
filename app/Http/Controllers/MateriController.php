<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
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
}
