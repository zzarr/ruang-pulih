<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;
use App\Models\ProgresTugas;
use App\Models\Laporan;

class MonitoringController extends Controller
{
    // Menampilkan semua progres tindak lanjut dari kader
    public function tindak()
    {
        $progres = ProgresTugas::with(['tugas.laporan', 'tugas.petugas'])
            ->select('progres_tugas.*')
            ->join('tugas_laporan', 'progres_tugas.tugas_id', '=', 'tugas_laporan.id')
            ->join('laporan', 'tugas_laporan.laporan_id', '=', 'laporan.id')
            ->orderByRaw("CASE WHEN laporan.status = 'selesai' THEN 1 ELSE 0 END") // selesai di belakang
            ->orderByDesc('progres_tugas.created_at') // urut terbaru
            ->get();

        return view('monitoring.monitoring-tindak_lanjut', compact('progres'));
    }

    // Update status laporan menjadi selesai
    public function update_tindak(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'selesai';
        $laporan->save();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil ditandai selesai.',
        ]);
    }

    // Menampilkan data konsultasi
    public function konsultasi()
    {
        $konsultasi = Konsultasi::with(['laporan.korban', 'user', 'konselor'])
            ->latest()
            ->get();
        return view('monitoring.monitoring-konsultasi', compact('konsultasi'));
    }
}
