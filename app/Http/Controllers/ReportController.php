<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Barryvdh\DomPDF\PDF as PDF;

class ReportController extends Controller
{
    public function generateUserListPDF($role)
    {
        $users = User::where('role', $role)->get();

        $data = [
            'title' => "Daftar $role",
            'users' => $users,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.pdf', $data);

        return $pdf->stream($role . '_user_list.pdf');      
    }

    public function cetakUsers()
    {
        $users = User::get();

        $data = [
            'title' => "Daftar User",
            'users' => $users,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.pdf', $data);

        return $pdf->stream('_user_list.pdf');
    }
    
}
