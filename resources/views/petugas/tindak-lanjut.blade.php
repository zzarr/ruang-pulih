@extends('pelaporan.petugas.app')
@section('title', 'tindak lanjut laporan')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Tindak Lanjut Laporan</h2>

        <div class="card mb-4">
            <div class="card-header">Detail Laporan</div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $report->reporter_name ?? '-' }}</p>
                <p><strong>Kontak:</strong> {{ $report->reporter_contact ?? '-' }}</p>
                <p><strong>Saluran:</strong> {{ ucfirst($report->report_channel) }}</p>
                <p><strong>Kategori:</strong> {{ $report->category->name ?? '-' }}</p>
                <p><strong>Detail:</strong><br>{{ $report->report_detail }}</p>
            </div>
        </div>

        <form action="{{ route('petugas.laporan.tindak.simpan', $report->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="notes" class="form-label">Catatan Tindak Lanjut</label>
                <textarea name="notes" id="notes" class="form-control" rows="5" required></textarea>
                @error('notes')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan Tindak Lanjut</button>
            <a href="{{ route('petugas.verifikasi') }}" class="btn btn-secondary ms-2">Kembali</a>
        </form>
    </div>
@endsection
