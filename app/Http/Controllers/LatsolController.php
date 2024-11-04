<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\Request;
use App\Models\Latsol;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\Tugas;
use App\Models\Soal;

class LatsolController extends Controller
{
    // Halaman daftar latihan soal
    public function latsol()
    {
        $latihanSoal = Latsol::with('tugas')->get();
        $materis = Materi::all();
        $tugas = Tugas::all();

        return view('guru.latsol', compact('latihanSoal', 'materis', 'tugas'));
    }

    // Menyimpan judul materi dan judul latihan soal
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
        // Cari data Latihansoal berdasarkan id
        $latihansoal = Latsol::findOrFail($id);

        // Hapus data latihansoal
        $latihansoal->delete();

        return redirect()->back()->with('status', 'Latihan soal berhasil dihapus.');
    }


    // Menampilkan halaman manage soal untuk tugas tertentu
    public function show($id_tugas)
    {
        $tugas = Tugas::with('latsols')->find($id_tugas); // ganti latsol dengan latsols

        // Periksa apakah tugas ditemukan
        if (!$tugas) {
            return redirect()->route('latsol')->with('error', 'Tugas tidak ditemukan.');
        }

        $soal = Soal::where('id_tugas', $id_tugas)->get();

        // Pastikan 'soal' dikirim ke view
        return view('guru.manage', compact('tugas', 'soal'));
    }



    // Menambah soal dan pilihan jawaban
    public function storeSoal(Request $request, $id_tugas)
    {
        // Debug untuk cek apakah id_tugas diterima
        // dd($id_tugas); 

        // Validasi request
        $request->validate([
            'pertanyaan' => 'required',
            // 'bobot_nilai' => 'required|numeric',
            'pilihanA' => 'required',
            'pilihanB' => 'required',
            'pilihanC' => 'required',
            'pilihanD' => 'required',
            'jawaban' => 'required|in:A,B,C,D',
        ]);

        Soal::create([
            'id_tugas' => $id_tugas,
            'pertanyaan' => $request->pertanyaan,
            // 'bobot_nilai' => $request->bobot_nilai,
            'pilihanA' => $request->pilihanA,
            'pilihanB' => $request->pilihanB,
            'pilihanC' => $request->pilihanC,
            'pilihanD' => $request->pilihanD,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan.');
    }

    // Siswa mengerjakan soal dan nilai disimpan
    public function submit(Request $request, $id_tugas)
    {
        $soalList = Soal::where('id_tugas', $id_tugas)->get();
        $totalSoal = $soalList->count(); // Jumlah total soal
        $correctAnswers = 0; // Jumlah jawaban benar
        $ni = auth()->user()->ni; // Ambil nomor induk siswa yang sedang login

        foreach ($soalList as $soal) {
            // Ambil jawaban siswa dari input form
            $userAnswer = $request->input('soal_' . $soal->id);

            // Validasi apakah siswa mengisi jawaban
            if ($userAnswer !== null) {
                // Cek jika jawaban benar, tambahkan ke jumlah jawaban benar
                if ($userAnswer == $soal->jawaban) {
                    $correctAnswers++;
                }

                // Simpan jawaban siswa ke dalam tabel jawaban
                Jawaban::create([
                    'id_soal' => $soal->id,
                    'ni' => $ni,
                    'jawaban_siswa' => $userAnswer,
                ]);
            }
        }

        // Hitung nilai akhir berdasarkan persentase jawaban benar
        $score = $totalSoal > 0 ? ($correctAnswers / $totalSoal) * 100 : 0;

        // Simpan nilai akhir siswa ke tabel 'nilai'
        Nilai::create([
            'id_tugas' => $id_tugas,
            'ni' => $ni,
            'nilai' => $score,
        ]);

        // Redirect atau tampilkan halaman hasil
        return redirect()->route('siswa.latsol.index');
    }

    

    // Halaman untuk siswa mengakses soal
    // public function IndexSiswa()
    // {
    //     $latihanSoal = Latsol::all();
    //     return view('siswa.latsol', compact('latihanSoal'));
    // }

    public function index()
{
    $userId = auth()->user()->ni; // Mendapatkan 'ni' pengguna yang sedang login

    // Ambil latihan soal yang belum dikerjakan oleh siswa
    $latihanList = Latsol::whereDoesntHave('nilaiByUser')->get();

    // Ambil latihan soal yang sudah dikerjakan oleh siswa beserta nilai
    $nilaiList = Latsol::whereHas('nilaiByUser')->with(['nilaiByUser'])->get();

    return view('latsol.index', compact('latihanList', 'nilaiList'));
}





    public function showSoal($id_tugas)
    {
        // Ambil daftar soal berdasarkan id_tugas
        $soalList = Soal::where('id_tugas', $id_tugas)->get();
        $latihanSoal = Latsol::where('id_tugas', $id_tugas)->first(); // Ambil judul latihan soal

        // Pastikan soal ditemukan, jika tidak tampilkan pesan error
        if ($soalList->isEmpty()) {
            return redirect()->back()->with('error', 'Soal belum tersedia untuk tugas ini.');
        }

        // Pastikan latihan soal ditemukan, jika tidak tampilkan pesan error
        if (!$latihanSoal) {
            return redirect()->back()->with('error', 'Latihan soal tidak ditemukan.');
        }

        // Kirim data soal, id_tugas, dan latihanSoal ke tampilan Blade
        return view('siswa.latsol', compact('soalList', 'id_tugas', 'latihanSoal'));
    }

}
