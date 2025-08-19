<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ReportLog;

class VerifikasiController extends Controller
{
    public function index()
    {
        // Ambil laporan yang belum diverifikasi
        $reports = Report::where('status', 'baru')->get();
        return view('pelaporan.petugas.verifikasi-laporan', compact('reports'));
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('pelaporan.petugas.edit-verifikasi-laporan', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:valid,tidak_valid',
        ]);

        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return redirect()->route('petugas.verifikasi')->with('success', 'Laporan berhasil diverifikasi.');
    }

    public function terverifikasi()
    {
        $reports = Report::whereIn('status', ['valid', 'tidak_valid'])->get();

        return view('pelaporan.petugas.terverifikasi', compact('reports'));
    }

    public function tindakLanjutForm($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status !== 'valid') {
            return redirect()->route('petugas.verifikasi.index')->with('error', 'Laporan belum valid.');
        }

        return view('pelaporan.petugas.tindak-lanjut', compact('report'));
    }

    public function tindakLanjutSimpan(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string',
        ]);

        $report = Report::findOrFail($id);

        ReportLog::create([
            'report_id' => $report->id,
            'user_id' => 1, // sementara
            'action' => 'tindak_lanjut',
            'notes' => $request->notes,
        ]);

        return redirect()->route('petugas.verifikasi')->with('success', 'Tindak lanjut berhasil disimpan.');
    }
}
