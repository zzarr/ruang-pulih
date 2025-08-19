@extends('pelaporan.petugas.app')

@section('title', 'Verifikasi Laporan')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Laporan Belum Diverifikasi</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Pelapor</th>
                    <th>Kontak</th>
                    <th>Saluran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->reporter_name ?? '-' }}</td>
                        <td>{{ $report->reporter_contact ?? '-' }}</td>
                        <td>{{ ucfirst($report->report_channel) }}</td>
                        <td>
                            <a href="{{ route('petugas.verifikasi.edit', $report->id) }}"
                                class="btn btn-sm btn-primary">Verifikasi</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada laporan baru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
