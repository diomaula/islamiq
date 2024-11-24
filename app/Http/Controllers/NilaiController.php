<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Materi;
use App\Models\Latsol;
use App\Models\Nilai;

class NilaiController extends Controller
{
    public function filterReport(Request $request)
    {
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

        $materiList = Materi::select('judulMateri')->distinct()->get();
        $latsolList = Latsol::select('judulLatsol')->distinct()->get();

        $role = $request->user()->role;
        $view = $role === 'kepala' ? 'kepala.dashboard' : 'guru.dashboard';

        return view($view, compact('reportData', 'materiList', 'latsolList'));
    }

    public function exportPdf(Request $request)
    {
        $role = $request->user()->role;
        
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

        $view = $role === 'kepala' ? 'kepala.pdf' : 'guru.pdf';
        $pdf = Pdf::loadView($view, compact('reportData'));

        return $pdf->download('laporan_nilai.pdf');
    }
}

