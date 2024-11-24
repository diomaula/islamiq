<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Latsol;
use App\Models\Materi;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        $report = new Report();

        $totalSiswa = $report->getTotalUsers('siswa');
        $totalGuru = $report->getTotalUsers('guru');
        $totalUsers = $report->getUsers();
        $title = "Admin | Dashboard";
        
        return view('admin.dashboard', [
            'title' => $title,
            'totalSiswa' => $totalSiswa,
            'totalGuru' => $totalGuru,
            'totalUsers' => $totalUsers,
        ]);
    }

    public function dashboard(Request $request)
    {
        $role = $request->user()->role; 

        $materiList = Materi::select('judulMateri')->distinct()->get();
        $latsolList = Latsol::select('judulLatsol')->distinct()->get();

        $view = $role === 'kepala' ? 'kepala.dashboard' : 'guru.dashboard';

        return view($view, compact('materiList', 'latsolList'));
    }
}
