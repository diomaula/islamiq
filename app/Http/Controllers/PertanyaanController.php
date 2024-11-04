<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    // Menampilkan detail soal
    public function show($id)
    {
        $soal = Soal::findOrFail($id);
        return view('guru.manage', compact('soal'));
    }

    public function edit($id)
{
    $soal = Soal::findOrFail($id);
    return view('guru.manage', compact('soal'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'pertanyaan' => 'required',
        'pilihanA' => 'required',
        'pilihanB' => 'required',
        'pilihanC' => 'required',
        'pilihanD' => 'required',
        'jawaban' => 'required|in:A,B,C,D',
    ]);

    $soal = Soal::findOrFail($id);
    $soal->update([
        'pertanyaan' => $request->pertanyaan,
        'pilihanA' => $request->pilihanA,
        'pilihanB' => $request->pilihanB,
        'pilihanC' => $request->pilihanC,
        'pilihanD' => $request->pilihanD,
        'jawaban' => $request->jawaban,
    ]);

    return redirect()->back();
}

public function destroy($id)
{
    $soal = Soal::findOrFail($id);
    $soal->delete();

    return redirect()->back();
}

}

