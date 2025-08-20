<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // bisa null kalau belum login

        $konsultasis = collect(); // default kosong

        // Hanya ambil data kalau user sudah login dan role-nya 'user'
        if ($user && $user->role === 'user') {
            $konsultasis = Konsultasi::with('konselor', 'user')->where('user_id', $user->id)->where('status', 'Proses')->latest()->get();
        }

        return view('home', compact('konsultasis', 'user'));
    }
}
