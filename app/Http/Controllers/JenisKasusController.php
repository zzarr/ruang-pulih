<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisKasus;

class JenisKasusController extends Controller
{
    public function index()
    {
        $jenisKasus = JenisKasus::all();
        return view('jenis_kasus.index', compact('jenisKasus'));
    }

    public function data()
    {
         return JenisKasus::select('id', 'nama')->get();
    }
}
