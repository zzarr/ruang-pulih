<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $konsultasis = collect();
        if ($user->role == 'user') {
            $konsultasis = Konsultasi::with('konselor', 'user')->where('user_id', $user->id)->where('status', 'Proses')->latest()->get();
        }

        return view('home', compact('konsultasis'));
    }
}
