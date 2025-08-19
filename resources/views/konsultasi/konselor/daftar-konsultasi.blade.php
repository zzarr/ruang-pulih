@extends('layout.app')
@section('title', 'Daftar Konsultasi')
@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Daftar Konsultasi</h4>

        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="konsultasiTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Korban</th>
                                <th>Jenis Kasus</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasi as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($row->laporan)
                                            {{ $row->laporan->korban->first()->nama_lengkap ?? '-' }}
                                        @else
                                            {{ $row->user->name ?? '-' }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($row->laporan)
                                            @php
                                                $kasus = json_decode($row->laporan->jenis_kasus, true);
                                            @endphp

                                            @if (is_array($kasus))
                                                @foreach ($kasus as $k)
                                                    <span class="badge bg-primary me-1">{{ $k }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-primary">{{ $row->laporan->jenis_kasus ?? '-' }}</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->laporan->alamat_kejadian ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $row->status ?? '-' }}</span>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary btnMulai"
                                            data-id="{{ $row->id }}">
                                            Terima Konsul
                                        </button>
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

            $(document).on('click', '.btnMulai', function() {
                let konsultasiId = $(this).data('id');
                let row = $(this).closest('tr');

                $.ajax({
                    url: "{{ route('konselor.konsultasi.terima') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: konsultasiId
                    },
                    success: function(res) {
                        if (res.success) {
                            row.find('.status-label')
                                .removeClass('bg-info')
                                .addClass('bg-success')
                                .text('proses');

                            row.find('.btnMulai')
                                .remove(); // hapus tombol agar tidak bisa klik lagi
                        } else {
                            alert(res.message || "Gagal memperbarui status!");
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert("Terjadi kesalahan server.");
                    }
                });
            });

        });
    </script>
@endpush
