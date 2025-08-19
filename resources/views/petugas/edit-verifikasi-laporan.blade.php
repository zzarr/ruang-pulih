@extends('pelaporan.petugas.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Verifikasi Laporan</h2>

        <div class="card mb-4">
            <div class="card-header">Detail Laporan</div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $report->reporter_name ?? '-' }}</p>
                <p><strong>Kontak:</strong> {{ $report->reporter_contact ?? '-' }}</p>
                <p><strong>Saluran:</strong> {{ ucfirst($report->report_channel) }}</p>
                <p><strong>Kategori:</strong> {{ $report->category->name ?? '-' }}</p>
                <p><strong>Detail:</strong><br> {{ $report->report_detail }}</p>
            </div>
        </div>

        <form action="{{ route('petugas.verifikasi.update', $report->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="status" class="form-label">Status Verifikasi</label>
                <select name="status" id="status" class="form-select">
                    <option value="valid">Valid</option>
                    <option value="tidak_valid">Tidak Valid</option>
                </select>
                @error('status')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('petugas.verifikasi') }}" class="btn btn-secondary ms-2">Kembali</a>
        </form>
    </div>
@endsection
