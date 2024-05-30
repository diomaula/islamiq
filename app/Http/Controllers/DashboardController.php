<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $report = new Report();

    $totalSiswa = $report->getTotalUsers('siswa');
    $totalGuru = $report->getTotalUsers('guru');
    $totalUsers = $report->getUsers();
    $title = "Dashboard Admin";
    
    return view('admin.dashboard', [
        'title' => $title,
        'totalSiswa' => $totalSiswa,
        'totalGuru' => $totalGuru,
        'totalUsers' => $totalUsers,
    ]);
}

public function indexKepsek()
{
    $report = new Report();

    $totalSiswa = $report->getTotalUsers('siswa');
    $totalGuru = $report->getTotalUsers('guru');
    $totalUsers = $report->getUsers();
    $title = "Dashboard Kepsek";
    
    return view('kepsek.dashboard', [
        'title' => $title,
        'totalSiswa' => $totalSiswa,
        'totalGuru' => $totalGuru,
        'totalUsers' => $totalUsers,
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
