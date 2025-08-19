<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\TugasLaporan;
use App\Models\JenisKasus;
use App\Models\Pelapor;
use App\Models\Terlapor;
use App\Models\Korban;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\ProgresTugas;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Laporan::with('pelapor', 'admin')->get();

        return view('laporan.admin.index', compact('reports'));
    }

    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $categories = JenisKasus::all();
        return view('laporan.kader.create-report', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tanggal_kejadian' => 'required|date',
            'alamat_kejadian' => 'required|string|max:255',
            'provinsi' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa_kelurahan' => 'required|string|max:100',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'jenis_kasus' => 'required|array',
            'jenis_kasus.*' => 'exists:jenis_kasus,id',
            'kasus_lainnya' => 'nullable|string|max:255',
            'kronologi' => 'required|string',
            'bukti_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf', // Maksimal 2MB
            'pelapor.nama_lengkap' => 'required|string|max:100',
            'pelapor.alamat' => 'nullable|string|max:255',
            'pelapor.no_telepon' => 'nullable|string|max:15',
            'terlapor.nama_lengkap' => 'nullable|string|max:100',
            'terlapor.alamat' => 'nullable|string|max:255',
            'terlapor.no_telepon' => 'nullable|string|max:15',
            'korban' => 'nullable|array',
            'korban.*.nama_lengkap' => 'required|string|max:100',
            'korban.*.hubungan_pelapor' => 'nullable|string|max:50',
            'korban.*.jenis_kelamin' => 'nullable|in:pria,wanita',
            'korban.*.difabelitas' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan laporan utama
            // 1. Simpan laporan utama
            $laporan = Laporan::create([
                'media_pengaduan' => $request->media_pengaduan ?? '-',
                'tanggal_laporan' => now(),
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'alamat_kejadian' => $request->alamat_kejadian,
                'provinsi' => $request->provinsi,
                'kabupaten_kota' => $request->kabupaten_kota,
                'kecamatan' => $request->kecamatan,
                'desa_kelurahan' => $request->desa_kelurahan,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'jenis_kasus' => json_encode($request->jenis_kasus), // array -> json
                'kasus_lainnya' => $request->kasus_lainnya,
                'kronologi' => $request->kronologi,
                'difabel' => $request->difabel ?? false,
                // simpan ke storage/app/bukti
                'bukti_path' => $request->hasFile('bukti_path') ? $request->file('bukti_path')->store('bukti') : null,
            ]);

            // 2. Simpan data pelapor
            $pelaporData = $request->input('pelapor');
            $pelapor = Pelapor::create([
                'laporan_id' => $laporan->id,
                'nama_lengkap' => $pelaporData['nama_lengkap'] ?? null,
                'alamat' => $pelaporData['alamat'] ?? null,
                'no_telepon' => $pelaporData['no_telepon'] ?? null,
            ]);

            // 3. Simpan data terlapor
            $terlaporData = $request->input('terlapor');
            $terlapor = Terlapor::create([
                'laporan_id' => $laporan->id,
                'nama_lengkap' => $terlaporData['nama_lengkap'] ?? null,
                'alamat' => $terlaporData['alamat'] ?? null,
                'no_telepon' => $terlaporData['no_telepon'] ?? null,
            ]);

            // 4. Simpan data korban (bisa lebih dari satu)
            $korbanList = $request->input('korban', []);
            foreach ($korbanList as $korbanData) {
                Korban::create([
                    'laporan_id' => $laporan->id,
                    'nama_lengkap' => $korbanData['nama_lengkap'] ?? null,
                    'hubungan_pelapor' => $korbanData['hubungan_pelapor'] ?? null,
                    'jenis_kelamin' => $korbanData['jenis_kelamin'] ?? null,
                    'usia' => $korbanData['usia'] ?? null,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil disimpan',
                'laporan_id' => $laporan->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function downloadBukti(Laporan $laporan)
    {
        // Cek izin akses
        if (!auth()->user()->isAdmin() && auth()->id() !== $laporan->pelapor_id) {
            abort(403, 'Anda tidak punya izin mengakses bukti ini.');
        }

        if (!$laporan->bukti_path || !Storage::disk('bukti')->exists($laporan->bukti_path)) {
            abort(404, 'Bukti tidak ditemukan.');
        }

        return Storage::disk('bukti')->download($laporan->bukti_path);
    }

    public function validasi(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }

    public function penugasan()
    {
        $reports = Laporan::with('pelapor', 'admin')->where('status', 'valid')->get();
        $kaders = User::where('role', 'kader')->get();

        return view('laporan.admin.penugasan', compact('reports', 'kaders'));
    }

    public function storePenugasan(Request $request)
    {
        $request->validate([
            'laporan_id' => ['required', 'exists:laporan,id'],
            'kader_id' => ['required', 'exists:users,id'],
            'tindak_lanjut' => ['required', Rule::in(['pendampingan', 'kunjungan', 'konsultasi', 'lainnya'])],
            'tindak_lanjut_lainnya' => ['required_if:tindak_lanjut,lainnya', 'nullable', 'string', 'max:100'],
            'catatan' => ['required', 'string'],
        ]);

        // Jika "lainnya", pakai input tambahan sebagai nilai final
        $tindak = $request->tindak_lanjut === 'lainnya' ? $request->tindak_lanjut_lainnya : $request->tindak_lanjut;

        // Simpan penugasan
        TugasLaporan::create([
            'laporan_id' => $request->laporan_id,
            'petugas_id' => $request->kader_id,
            'jenis_tindak_lanjut' => $tindak,
            'catatan' => $request->catatan,
        ]);

        if ($request->tindak_lanjut === 'konsultasi') {
            // Buat konsultasi baru
            $konselorId = User::where('role', 'konselor')->first()->id ?? null;

            if ($konselorId) {
                Konsultasi::create([
                    'user_id' => $request->kader_id,
                    'laporan_id' => $request->laporan_id,
                    'konselor_id' => $konselorId,
                    'status' => 'pending',
                ]);
            }
        }

        $laporan = Laporan::findOrFail($request->laporan_id);
        $laporan->status = 'proses';
        $laporan->save();

        return response()->json(['message' => 'Laporan berhasil ditugaskan ke kader.']);
    }

    public function penugasanKader()
    {
        $tugas = TugasLaporan::with(['laporan', 'petugas'])
            ->where('petugas_id', auth()->id())
            ->where('jenis_tindak_lanjut', '!=', 'konsultasi')
            ->whereDoesntHave('progres') // ⬅️ hanya yang belum ada progress
            ->get();

        return view('laporan.kader.tugas-penanganan', compact('tugas'));
    }

    public function show($id)
    {
        $laporan = Laporan::with(['pelaporUser', 'korban', 'pelapor'])->findOrFail($id);

        $jenisKasus = $laporan->jenis_kasus;
        if (!is_array($jenisKasus)) {
            $jenisKasus = $jenisKasus ? explode(',', $jenisKasus) : [];
        }

        // Bersihkan tanda kutip dari tiap elemen
        $jenisKasus = array_map(function ($item) {
            return trim($item, "\""); // hapus " di awal/akhir
        }, $jenisKasus);

        return response()->json([
            'id' => $laporan->id,
            'pelapor' => $laporan->pelapor->nama_lengkap ?? '-',
            'jenis_kasus' => $jenisKasus,
            'deskripsi' => $laporan->kronologi,
            'lokasi' => $laporan->alamat_kejadian . ' RT ' . $laporan->rt . ' / RW ' . $laporan->rw,
            'status' => $laporan->status,
            'bukti' => $laporan->bukti_path,
            'korban' => $laporan->korban
                ? [
                    'nama' => $laporan->korban->nama_lengkap,
                    'usia' => $laporan->korban->usia,
                    'jk' => $laporan->korban->jenis_kelamin,
                ]
                : null,
        ]);
    }

    public function progresStore(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas_laporan,id',
            'deskripsi_tindak_lanjut' => 'required|string',
            'bukti_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['tugas_id', 'deskripsi_tindak_lanjut']);

        if ($request->hasFile('bukti_path')) {
            $data['bukti_path'] = $request->file('bukti_path')->store('bukti', 'public');
        }

        ProgresTugas::create($data);

        return response()->json(['success' => true, 'message' => 'Tugas berhasil diselesaikan']);
    }
}
