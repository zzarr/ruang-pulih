@extends('layout.app')

@section('title', 'Monitoring Konsultasi')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Monitoring Konsultasi</h4>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="konsultasiTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Korban</th>
                                <th>Konselor</th>
                                <th>Topik</th>
                                <th>Metode</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    {{-- Nama Korban --}}
                                    <td>
                                        @if ($item->laporan && $item->laporan->korban)
                                            {{ $item->laporan->korban->nama_lengkap }}
                                        @elseif ($item->user)
                                            {{ $item->user->name }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    {{-- Nama Konselor --}}
                                    <td>{{ $item->konselor ? $item->konselor->name : '-' }}</td>

                                    {{-- Topik --}}
                                    <td>{{ $item->topik ?? '-' }}</td>

                                    {{-- Metode --}}
                                    <td>{{ $item->metode ?? '-' }}</td>

                                    {{-- Jadwal --}}
                                    <td>{{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal)->format('d-m-Y H:i') : '-' }}
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if ($item->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif ($item->status == 'berjalan')
                                            <span class="badge bg-warning text-dark">Berjalan</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($item->status ?? '-') }}</span>
                                        @endif
                                    </td>

                                    {{-- Catatan --}}
                                    <td>{{ $item->catatan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('#konsultasiTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ]
            });
        });
    </script>
@endpush
