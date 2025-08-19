@extends('layout.app')
@section('title', 'Laporan Pengaduan')

@section('content')

    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="">
            <h1 class="page-title fw-semibold fs-20 mb-0">
                Daftar Laporan Pengaduan
            </h1>
            <div class="">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Daftar Laporan Pengaduan
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>





    <div class="card custom-card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="laporanTable" class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Pelapor</th>
                            <th>Jenis Kasus</th>

                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $index => $laporan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $laporan->pelapor ? $laporan->pelapor->nama_lengkap : 'Anonim' }}</td>
                                <td>
                                    @php
                                        $kasus = json_decode($laporan->jenis_kasus, true);
                                    @endphp

                                    @if (is_array($kasus))
                                        @foreach ($kasus as $item)
                                            <span class="badge bg-primary me-1">{{ $item }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-primary">{{ $laporan->jenis_kasus }}</span>
                                    @endif
                                </td>


                                <td>
                                    @if ($laporan->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($laporan->status == 'proses')
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    @elseif($laporan->status == 'valid')
                                        <span class="badge bg-primary">Valid</span>
                                    @elseif($laporan->status == 'invalid')
                                        <span class="badge bg-danger">Invalid</span>
                                    @else
                                        <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm btnDetail" data-id="{{ $laporan->id }}"
                                        data-pelapor="{{ $laporan->pelapor->name ?? 'Anonim' }}"
                                        data-jenis="{{ $laporan->jenis_kasus }}" data-deskripsi="{{ $laporan->kronologi }}"
                                        data-alamat="{{ $laporan->alamat_kejadian }}"
                                        data-status="{{ $laporan->status ?? 'pending' }}"
                                        data-bukti="{{ $laporan->bukti_path ? asset('storage/' . $laporan->bukti_path) : '' }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>




    <!-- Modal Detail -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="laporanId" value=""> <!-- Ini penting untuk simpan ID -->
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Pelapor</th>
                                <td id="detailPelapor"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kasus</th>
                                <td id="detailJenis"></td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td id="detailDeskripsi"></td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td id="detailLokasi"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="detailStatus"></td>
                            </tr>
                            <tr>
                                <th>Bukti</th>
                                <td id="detailBukti">
                                    <!-- Gambar bukti akan dimasukkan di sini -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="modal-footer">
                    <input type="hidden" id="laporanId">
                    <button type="button" class="btn btn-success" id="btnValid">Valid</button>
                    <button type="button" class="btn btn-danger" id="btnInvalid">Invalid</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script>
        $(document).ready(function() {
            $('#laporanTable').DataTable({
                responsive: true

            });

            $(document).on('click', '.btnDetail', function() {
                let id = $(this).data('id');
                let pelapor = $(this).data('pelapor');
                let jenis = $(this).data('jenis');
                let deskripsi = $(this).data('deskripsi');
                let lokasi = $(this).data('alamat');
                let status = $(this).data('status');
                let bukti = $(this).data('bukti');

                $('#laporanId').val(id);
                $('#detailPelapor').text(pelapor);
                $('#detailJenis').text(jenis);
                $('#detailDeskripsi').text(deskripsi);
                $('#detailLokasi').text(lokasi);
                $('#detailStatus').text(status);

                if (bukti) {
                    $('#detailBukti').html(
                        `<img src="${bukti}" alt="Bukti" class="img-fluid" style="max-width: 200px;">`
                    );
                } else {
                    $('#detailBukti').html('<span>Tidak ada bukti</span>');
                }


                $('#modalDetail').modal('show');
            });


            // Validasi via AJAX
            function updateStatus(status) {
                let id = $('#laporanId').val();

                $.ajax({
                    url: "{{ route('admin.laporan.validasi', ':id') }}".replace(':id', id),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        $('#detailStatus').text(status);
                        let badgeClass = status === 'valid' ? 'bg-success' : 'bg-danger';
                        $(`#row-${id} .status-col`).html(
                            `<span class="badge ${badgeClass}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`
                        );
                        $('#modalDetail').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Gagal update status');
                    }
                });
            }

            $('#btnValid').click(function() {
                updateStatus('valid');
            });
            $('#btnInvalid').click(function() {
                updateStatus('invalid');
            });
        });
    </script>
@endpush
