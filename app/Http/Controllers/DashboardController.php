<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasLaporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin.index');
    }

    public function kader()
    {
        // Ambil tugas yang ditugaskan ke kader yang sedang login
        $tugas = TugasLaporan::with(['laporan', 'petugas'])
            ->where('petugas_id', Auth::id())
            ->get();
        return view('dashboard.kader.index', compact('tugas'));
    }

    public function konselor()
    {
        return view('dashboard.konselor.index');
    }
}
