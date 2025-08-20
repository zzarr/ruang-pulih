<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Konsultasi;
use App\Models\Laporan;
use App\Models\User;
use App\Models\TugasLaporan;
use App\Models\JenisKasus;
use App\Models\ChatKonsultasi;

class KonsultasiController extends Controller
{
    public function konsultasiKorban()
    {
        $tugas = TugasLaporan::with([
            'laporan.konsultasi',
            'laporan.korban', // relasi korban
            'petugas',
        ])
            ->where('petugas_id', auth()->id())
            ->where('jenis_tindak_lanjut', 'konsultasi')
            ->get();

        return view('konsultasi.kader.konsultasi-korban', compact('tugas'));
    }

    public function daftarKonsultasiKonselor()
    {
        $konsultasi = Konsultasi::with(['chats.user'])
            ->where('status', 'pending')
            ->get();

        return view('konsultasi.konselor.daftar-konsultasi', compact('konsultasi'));
    }

    public function terimaKonsul(Request $request)
    {
        try {
            $konsultasi = Konsultasi::findOrFail($request->id);
            $konsultasi->status = 'proses';
            $konsultasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Konsultasi berhasil diterima.',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function show($id)
    {
        $konsultasi = Konsultasi::with(['chats.pengirim'])->findOrFail($id);

        return view('konsultasi.kader.show', compact('konsultasi'));
    }

    public function send(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required|string|max:500',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);

        $chat = new ChatKonsultasi();
        $chat->konsultasi_id = $konsultasi->id;
        $chat->pengirim_id = auth()->id();
        $chat->pesan = $request->pesan;
        $chat->save();

        $user = Auth::user();

        if ($user->role === 'kader') {
            return redirect()->route('kader.konsultasi.chat', $id)->with('success', 'Pesan berhasil dikirim');
        } elseif ($user->role === 'user') {
            return redirect()->route('konsultasi.show', $id)->with('success', 'Pesan berhasil dikirim');
        }
    }

    // Daftar konsultasi untuk konselor
    public function indexKonselor()
    {
        $konsultasi = Konsultasi::with(['laporan.korban', 'chats', 'user'])
            ->whereIn('status', ['pending', 'proses'])
            ->get();

        return view('konsultasi.konselor.konsultasi-proses', compact('konsultasi'));
    }

    // Kirim pesan
    public function sendKonselor(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required|string|max:500',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);

        $chat = new ChatKonsultasi();
        $chat->konsultasi_id = $konsultasi->id;
        $chat->pengirim_id = auth()->id();
        $chat->pesan = $request->pesan;
        $chat->save();

        return redirect()->route('konselor.konsultasi.chat', $id);
    }

    // Load chat via AJAX
    public function chatAjax($id)
    {
        $konsultasi = Konsultasi::with(['laporan.korban', 'chats'])->findOrFail($id);

        return view('konsultasi.konselor.chat', compact('konsultasi'))->render();
    }

    public function tutupSesi(Request $request)
    {
        $request->validate([
            'konsultasi_id' => 'required|exists:konsultasi,id',
            'catatan' => 'required|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($request->konsultasi_id);
        $konsultasi->catatan = $request->catatan;
        $konsultasi->status = 'selesai';
        $konsultasi->save();

        return response()->json(['success' => true, 'message' => 'Sesi konsultasi berhasil ditutup']);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'topik' => 'required|string|max:255',
        ]);

        // Ambil random user dengan role 'konselor'
        $konselor = User::where('role', 'konselor')->inRandomOrder()->first();

        // Buat data konsultasi baru
        $konsultasi = Konsultasi::create([
            'user_id' => Auth::id(),
            'laporan_id' => null, // Bisa diisi jika terkait laporan tertentu
            'konselor_id' => $konselor ? $konselor->id : null,
            'status' => 'pending',
            'metode' => 'chat',
            'topik' => $request->topik,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Konseling berhasil dibuat',
            'data' => $konsultasi,
        ]);
    }

    public function showChat($id)
    {
        // ambil data konsultasi beserta relasinya
        // ambil data konsultasi beserta relasinya, hanya yang statusnya bukan 'selesai'
        $konsultasi = Konsultasi::with(['konselor', 'laporan.korban', 'chats'])
            ->where('id', $id)
            ->where('status', '!=', 'selesai')
            ->firstOrFail();

        $user = Auth::user();

        $konsultasis = collect();
        if ($user->role == 'user') {
            $konsultasis = Konsultasi::with('konselor', 'user')->where('user_id', $user->id)->where('status', 'Proses')->latest()->get();
        }

        return view('show-chat', compact('konsultasi', 'konsultasis'));
    }
}
