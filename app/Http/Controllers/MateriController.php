<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::paginate(5);

        return view('guru.materi', ['materis' => $materis]);
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
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('fileMateri')) {
            $file = $request->file('fileMateri');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $data['fileMateri'] = $fileName;
        }

        Materi::create($data);

        return redirect()->route('guru.materi')
            ->with('success', 'Data materi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return abort(404);
        }

        return view('guru.materi', compact('materi'));
    }

    public function edit($id)
    {
        $materi = Materi::find($id);
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judulMateri' => 'required|max:255',
            'fileMateri' => 'nullable|mimes:pdf|max:20480', // 20MB limit
        ]);

        $data = $request->only('judulMateri');

        if ($request->hasFile('fileMateri')) {
            $file = $request->file('fileMateri');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $data['fileMateri'] = $fileName;
        }

        Materi::where('id_materi', $id)->update($data);

        return redirect()->route('materi.index')
            ->with('success', 'Data materi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $materi = Materi::find($id);

        if ($materi) {
            if ($materi->fileMateri && file_exists(public_path('uploads/' . $materi->fileMateri))) {
                unlink(public_path('uploads/' . $materi->fileMateri));
            }

            $materi->delete();

            return redirect()->route('materi.index')
                ->with('success', 'Data materi berhasil dihapus.');
        } else {
            return abort(404);
        }
    }
}
