@extends('layout.app')
@section('title', 'Tugas Penanganan Kader')
@section('content')
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="">
            <h1 class="page-title fw-semibold fs-20 mb-0">
                Tugas Penanganan Kader
            </h1>
            <div class="">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tugas Penanganan Kader
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <h4 class="mb-4"></h4>
    <div class="card custom-card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tugasTable" class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Korban</th>
                            <th>Jenis kekerasan</th>
                            <th>Lokasi</th>
                            <th>Tindak Lanjut</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $index => $item)
                            <tr>
                                <td style="width: 5%;">{{ $index + 1 }}</td>
                                <td>
                                    {{ $item->laporan->korban->first()->nama_lengkap ?? '-' }}
                                </td>
                                <td>
                                    @php
                                        $kasus = json_decode($item->laporan->jenis_kasus, true);
                                    @endphp

                                    @if (is_array($kasus))
                                        @foreach ($kasus as $k)
                                            <span class="badge bg-primary me-1">{{ $k }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-primary">{{ $item->laporan->jenis_kasus }}</span>
                                    @endif
                                </td>

                                <td>{{ $item->laporan->alamat_kejadian }}</td>

                                <td>

                                    <span class="badge bg-secondary">{{ $item->jenis_tindak_lanjut }}</span>

                                </td>

                                <td>
                                    <!-- Aksi bisa ditambahkan sesuai kebutuhan -->
                                    <button class="btn btn-info btn-sm btn-detail"
                                        data-id="{{ $item->laporan_id }}">Detail</button>

                                    @if ($item->tindak_lanjut !== 'konsultasi')
                                        <button class="btn btn-success btn-sm btn-selesai"
                                            data-id="{{ $item->id }}">Selesaikan</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Laporan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="laporanId">

                    <!-- Info Laporan -->
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Pelapor</th>
                                <td id="detailPelapor"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kasus Kekerasan</th>
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
                                <td id="detailBukti"></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Info Korban -->
                    <h6 class="fw-bold">Data Korban</h6>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Nama</th>
                                <td id="korbanNama"></td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                                <td id="korbanUsia"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td id="korbanJk"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Penyelesaian Tugas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form id="formSelesai" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tugas_id" id="tugasId">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Tindak Lanjut</label>
                            <textarea class="form-control" name="deskripsi_tindak_lanjut" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Bukti</label>
                            <input type="file" class="form-control" name="bukti_path" accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
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
            $('#tugasTable').DataTable({
                responsive: true,
                autoWidth: false, // biar ngikutin 100%
            });

            $(document).on('click', '.btn-detail', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "/kader/laporan/" + id + "/detail",
                    type: "GET",
                    success: function(data) {
                        $('#laporanId').val(data.id);
                        $('#detailPelapor').text(data.pelapor);
                        if (data.jenis_kasus && data.jenis_kasus.length > 0) {
                            let badges = '';
                            data.jenis_kasus.forEach(function(kasus) {
                                kasus = kasus.replace(/"/g, ''); // hapus tanda kutip
                                badges +=
                                    `<span class="badge bg-info text-dark me-1">${kasus}</span>`;
                            });
                            $('#detailJenis').html(badges);
                        } else {
                            $('#detailJenis').html('<span class="badge bg-secondary">-</span>');
                        }
                        $('#detailDeskripsi').text(data.deskripsi);
                        $('#detailLokasi').text(data.lokasi);
                        $('#detailStatus').text(data.status);

                        if (data.bukti) {
                            $('#detailBukti').html(
                                `<img src="/storage/${data.bukti}" class="img-thumbnail" style="max-width:200px; height:auto;">`
                            );
                        } else {
                            $('#detailBukti').text('-');
                        }

                        if (data.korban) {
                            $('#korbanNama').text(data.korban.nama);
                            $('#korbanUsia').text(data.korban.usia);
                            $('#korbanJk').text(data.korban.jk);
                        } else {
                            $('#korbanNama').text('-');
                            $('#korbanUsia').text('-');
                            $('#korbanJk').text('-');
                        }

                        // Bootstrap 5 show modal
                        let modalDetail = new bootstrap.Modal(document.getElementById(
                            'modalDetail'));
                        modalDetail.show();
                    },
                    error: function() {
                        alert('Gagal mengambil data laporan!');
                    }
                });
            });

            $(document).on('click', '.btn-selesai', function() {
                let id = $(this).data('id');
                $('#tugasId').val(id);

                let modalSelesai = new bootstrap.Modal(document.getElementById('modalSelesai'));
                modalSelesai.show();
            });

            $('#formSelesai').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('kader.tugas.store.progres') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            alert(res.message);
                            $('#modalSelesai').modal('hide');
                            location.reload(); // refresh tabel
                        }
                    },
                    error: function(xhr) {
                        alert('Gagal menyimpan penyelesaian!');
                    }
                });
            });

        });
    </script>
@endpush
