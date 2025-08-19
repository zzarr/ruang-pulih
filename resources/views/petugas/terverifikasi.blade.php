@extends('pelaporan.petugas.app')
@section('title', 'LAPORAN TERVERIFIKASI')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Laporan Sudah Diverifikasi</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Pelapor</th>
                    <th>Kontak</th>
                    <th>Saluran</th>
                    <th>Status</th>
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
                            <span class="badge bg-{{ $report->status == 'valid' ? 'success' : 'secondary' }}">
                                {{ ucfirst($report->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($report->status === 'valid')
                                <a href="{{ route('petugas.laporan.tindak.form', $report->id) }}"
                                    class="btn btn-sm btn-warning">Tindak Lanjut</a>
                            @else
                                <span class="text-muted">Tidak perlu</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada laporan yang diverifikasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
