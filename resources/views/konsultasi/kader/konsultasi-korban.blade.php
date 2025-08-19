@extends('layout.app')
@section('title', 'Konsultasi Korban')
@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Konsultasi Korban</h4>

        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="konsultasiTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Korban</th>
                                <th class="d-none d-md-table-cell">Jenis Kasus</th>
                                <th class="d-none d-md-table-cell">Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tugas as $index => $row)
                                <tr>
                                    <td style="width: 5%;">{{ $index + 1 }}</td>
                                    <td>{{ $row->laporan->korban->first()->nama_lengkap ?? '-' }}</td>

                                    <td class="d-none d-md-table-cell">
                                        @php
                                            $kasus = json_decode($row->laporan->jenis_kasus, true);
                                        @endphp
                                        @if (is_array($kasus))
                                            @foreach ($kasus as $k)
                                                <span class="badge bg-primary me-1">{{ $k }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-primary">{{ $row->laporan->jenis_kasus }}</span>
                                        @endif
                                    </td>

                                    <td class="d-none d-md-table-cell">
                                        {{ $row->laporan->alamat_kejadian ?? '-' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('kader.konsultasi.chat', $row->laporan->konsultasi->id) }}"
                                            class="btn btn-sm btn-primary {{ $row->laporan->konsultasi->status == 'pending' ? 'disabled' : '' }}">
                                            Mulai Konsultasi
                                        </a>
                                    </td>
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
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('#konsultasiTable').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
    </script>
@endpush
