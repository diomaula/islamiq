<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jawaban;
use App\Models\Latsol;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\Tugas;
use App\Models\Soal;

class LatsolController extends Controller
{
    public function latsol()
    {
        $latihanSoal = Latsol::with('tugas')->get();
        $materis = Materi::all();
        $tugas = Tugas::all();

        return view('guru.latsol', compact('latihanSoal', 'materis', 'tugas'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'judulMateri' => 'required',
            'judulLatsol' => 'required',
        ]);

        $materi = Materi::where('judulMateri', $request->judulMateri)->first();

        if (!$materi) {
            return redirect()->back()->withErrors(['error' => 'Materi tidak ditemukan.']);
        }

        $tugas = Tugas::create(['id_materi' => $materi->id_materi]);

        Latsol::create([
            'judulMateri' => $request->judulMateri,
            'judulLatsol' => $request->judulLatsol,
            'id_tugas' => $tugas->id_tugas,
        ]);

        return redirect()->back()->with('status', 'Judul latihan soal berhasil ditambahkan.');
    }
  
    public function destroy($id)
    {
        $latihansoal = Latsol::findOrFail($id);
        $latihansoal->delete();

        return redirect()->back()->with('status', 'Latihan soal berhasil dihapus.');
    }

    public function show($id_tugas)
    {
        $tugas = Tugas::with('latsols')->find($id_tugas); 

        if (!$tugas) {
            return redirect()->route('latsol')->with('error', 'Tugas tidak ditemukan.');
        }

        $soal = Soal::where('id_tugas', $id_tugas)->get();

        return view('guru.manage', compact('tugas', 'soal'));
    }

    public function storeSoal(Request $request, $id_tugas)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'pilihanA' => 'required',
            'pilihanB' => 'required',
            'pilihanC' => 'required',
            'pilihanD' => 'required',
            'jawaban' => 'required|in:A,B,C,D',
        ]);

        Soal::create([
            'id_tugas' => $id_tugas,
            'pertanyaan' => $request->pertanyaan,
            'pilihanA' => $request->pilihanA,
            'pilihanB' => $request->pilihanB,
            'pilihanC' => $request->pilihanC,
            'pilihanD' => $request->pilihanD,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan.');
    }

    public function submit(Request $request, $id_tugas)
    {
        $soalList = Soal::where('id_tugas', $id_tugas)->get();
        $totalSoal = $soalList->count(); 
        $correctAnswers = 0; 
        $ni = auth()->user()->ni; 

        foreach ($soalList as $soal) {
            $userAnswer = $request->input('soal_' . $soal->id);

            if ($userAnswer !== null) {
                if ($userAnswer == $soal->jawaban) {
                    $correctAnswers++;
                }

                Jawaban::create([
                    'id_soal' => $soal->id,
                    'ni' => $ni,
                    'jawaban_siswa' => $userAnswer,
                ]);
            }
        }

        $score = $totalSoal > 0 ? ($correctAnswers / $totalSoal) * 100 : 0;

        Nilai::create([
            'id_tugas' => $id_tugas,
            'ni' => $ni,
            'nilai' => $score,
        ]);

        return redirect()->route('siswa.latsol.index');
    }

    public function index()
    {
        $userId = auth()->user()->ni;
        $latihanList = Latsol::whereDoesntHave('nilaiByUser')->get();
        $nilaiList = Latsol::whereHas('nilaiByUser')->with(['nilaiByUser'])->get();

        return view('latsol.index', compact('latihanList', 'nilaiList'));
    }

    public function showSoal($id_tugas)
    {
        $soalList = Soal::where('id_tugas', $id_tugas)->get();
        $latihanSoal = Latsol::where('id_tugas', $id_tugas)->first(); 

        if ($soalList->isEmpty()) {
            return redirect()->back()->with('error', 'Soal belum tersedia untuk tugas ini.');
        }

        if (!$latihanSoal) {
            return redirect()->back()->with('error', 'Latihan soal tidak ditemukan.');
        }

        return view('siswa.latsol', compact('soalList', 'id_tugas', 'latihanSoal'));
    }

}
