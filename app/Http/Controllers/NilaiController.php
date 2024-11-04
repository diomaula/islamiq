<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Latsol;
use App\Models\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function dashboard(Request $request)
    {
        $role = $request->user()->role; // Ambil role dari pengguna yang sedang login

        $materiList = Materi::select('judulMateri')->distinct()->get();
        $latsolList = Latsol::select('judulLatsol')->distinct()->get();

        // Pilih view berdasarkan role
        $view = $role === 'kepala' ? 'kepala.dashboard' : 'guru.dashboard';

        return view($view, compact('materiList', 'latsolList'));
    }


    public function filterReport(Request $request)
{
    // Memuat relasi user (siswa) dan latihansoal
    $query = Nilai::with(['siswa', 'latihansoal']); // Ubah 'latsol' menjadi 'latihansoal'

    // Filter berdasarkan judulMateri
    if ($request->judulMateri) {
        $query->whereHas('latihansoal', function ($query) use ($request) {
            $query->where('judulMateri', $request->judulMateri);
        });
    }

    // Filter berdasarkan judulLatsol
    if ($request->judulLatsol) {
        $query->whereHas('latihansoal', function ($query) use ($request) {
            $query->where('judulLatsol', $request->judulLatsol);
        });
    }

    $reportData = $query->get();

    // Mengambil daftar judulMateri dan judulLatsol untuk dropdown
    $materiList = Materi::select('judulMateri')->distinct()->get();
    $latsolList = Latsol::select('judulLatsol')->distinct()->get();

    // Memeriksa role pengguna untuk menentukan view yang digunakan
    $role = $request->user()->role;
    $view = $role === 'kepala' ? 'kepala.dashboard' : 'guru.dashboard';

    return view($view, compact('reportData', 'materiList', 'latsolList'));
}


    

public function exportPdf(Request $request)
{
    $role = $request->user()->role; // Ambil role dari pengguna yang sedang login
    
    $query = Nilai::with(['siswa', 'latihansoal']);

    if ($request->judulMateri) {
        $query->whereHas('latihansoal', function ($query) use ($request) {
            $query->where('judulMateri', $request->judulMateri);
        });
    }

    if ($request->judulLatsol) {
        $query->whereHas('latihansoal', function ($query) use ($request) {
            $query->where('judulLatsol', $request->judulLatsol);
        });
    }

    $reportData = $query->get();

    // Pilih view PDF berdasarkan role
    $view = $role === 'kepala' ? 'kepala.pdf' : 'guru.pdf';
    $pdf = Pdf::loadView($view, compact('reportData'));

    return $pdf->download('laporan_nilai.pdf');
}


}

