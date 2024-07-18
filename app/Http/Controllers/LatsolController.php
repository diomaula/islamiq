<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Latsol;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\Tugas;

class LatsolController extends Controller
{
    public function latsol()
    {
        $tugas = Tugas::all();

        if ($tugas->isEmpty()) {
            $latihanSoal = Latsol::all();
            return view('guru.latsol', compact('latihanSoal', 'materis', 'tugas'));
        }
        
        // $latihanSoal = Latsol::all();
        $latihanSoal = Latsol::select('id_tugas',
            DB::raw('MAX(id_latihan) as id_latihan'), 
            DB::raw('MIN(judulMateri) as judulMateri'), 
            DB::raw('MIN(judulLatsol) as judulLatsol'))
            ->groupBy('id_tugas')
            ->get();
        
        $materis = Materi::all();
        return view('guru.latsol', compact('latihanSoal', 'materis', 'tugas'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'judulMateri' => 'required',
            'judulLatsol' => 'required',
            'pertanyaan.*' => 'required',
            'bobot_nilai.*' => 'required|numeric',
            'pilihanA.*' => 'required',
            'pilihanB.*' => 'required',
            'pilihanC.*' => 'required',
            'pilihanD.*' => 'required',
            'jawaban.*' => 'required',
        ]);

        $judulMateri = $request->judulMateri;
        $judulLatsol = $request->judulLatsol;
        $jumlah_soal = $request->jumlah_soal;
        $materi = Materi::where('judulMateri', $judulMateri)->first();

        $id_materi = $materi->id_materi;

        $tugas = Tugas::create([
            'id_materi' => $id_materi,
        ]);

        $latsol = new Latsol();
        for ($i = 0; $i < $jumlah_soal; $i++) {
            Latsol::create([
                'judulMateri' => $judulMateri,
                'judulLatsol' => $judulLatsol,
                'pertanyaan' => $request->pertanyaan[$i],
                'bobot_nilai' => $request->bobot_nilai[$i],
                'pilihanA' => $request->pilihanA[$i],
                'pilihanB' => $request->pilihanB[$i],
                'pilihanC' => $request->pilihanC[$i],
                'pilihanD' => $request->pilihanD[$i],
                'jawaban' => $request->jawaban[$i],
                'id_tugas' => $tugas->id_tugas,
            ]);
        }

        return redirect()->back()->with('status', 'Data latihan soal berhasil ditambahkan.');
    }


    public function show($id_tugas)
    {
        $tugas = Tugas::find($id_tugas);
        $latihanSoal = Latsol::where('id_tugas', $tugas->id)->get();
        $soals = Latsol::where('id_tugas', $latihanSoal)->get();
        dd($soals);

        // return view('latsol.show', compact('tugas', 'latihanSoal', 'soals'));
    }

    public function update(Request $request, $id_latihan)
    {
        $request->validate([
            'judulMateri' => 'required',
            'isiLatihanSoal' => 'required',
            'nilai' => 'required|numeric',
            'pilihan1' => 'required',
            'pilihan2' => 'required',
            'pilihan3' => 'required',
            'pilihan4' => 'required',
            'jawaban' => 'required',
        ]);

        $latihanSoal = Latsol::find($id_latihan);

        $latihanSoal->update([
            'judulMateri' => $request->judulMateri,
            'isiLatihanSoal' => $request->isiLatihanSoal,
            'nilai' => $request->nilai,
            'pilihan1' => $request->pilihan1,
            'pilihan2' => $request->pilihan2,
            'pilihan3' => $request->pilihan3,
            'pilihan4' => $request->pilihan4,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->route('latsol')->with('success', 'Data latihan soal berhasil diperbarui.');
    }

    public function destroy($id_tugas)
    {
        $bks = Latsol::find($id_tugas);

        $bks->delete();

        return redirect()->route('latsol')->with('success', 'Data latihan soal berhasil dihapus.');
    }
}