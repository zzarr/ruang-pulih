@extends('layout.app')
@section('title', 'Monitoring Tindak Lanjut')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Monitoring Tindak Lanjut Kader</h4>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tindakTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Laporan</th>
                                <th>Kader</th>
                                <th>Catatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progres as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tugas->laporan->pelaporUser->name ?? 'Anonim' }}</td>
                                    <td>
                                        @php
                                            $kasus = json_decode($item->tugas->laporan->jenis_kasus, true);
                                        @endphp

                                        @if (is_array($kasus))
                                            @foreach ($kasus as $k)
                                                <span class="badge bg-primary me-1">{{ $k }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-primary">{{ $item->tugas->laporan->jenis_kasus }}</span>
                                        @endif
                                    </td>


                                    </td>
                                    <td>{{ $item->tugas->petugas->name ?? '-' }}</td>
                                    <td>{{ $item->deskripsi_tindak_lanjut }}</td>
                                    <td>
                                        @if ($item->bukti_path)
                                            <a href="{{ asset('storage/' . $item->bukti_path) }}" target="_blank">Lihat
                                                Bukti</a>
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm btnSelesai"
                                            data-id="{{ $item->id }}">Selesai</button>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endpush
@push('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#tindakTable').DataTable({
                responsive: true,
            });

            $(document).on('click', '.btnSelesai', function() {
                let id = $(this).data('id');
                if (confirm("Apakah Anda yakin ingin menandai laporan ini selesai?")) {
                    $.ajax({
                        url: "{{ route('admin.monitoring.update_tindak', ':id') }}".replace(':id',
                            id),
                        type: "PUT",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.success) {
                                alert(res.message);
                                location.reload();
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.btnSelesai', function() {
                let id = $(this).data('id');
                if (confirm("Apakah Anda yakin ingin menandai laporan ini selesai?")) {
                    $.ajax({
                        url: "{{ route('admin.monitoring.update_tindak', ':id') }}".replace(':id',
                            id),
                        type: "PUT",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.success) {
                                alert(res.message);
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
