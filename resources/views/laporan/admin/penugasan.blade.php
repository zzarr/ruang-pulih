@extends('layout.app')
@section('title', 'Laporan Pengaduan')

@section('content')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="">
                <h1 class="page-title fw-semibold fs-20 mb-0">
                    Penugasan Laporan Pengaduan
                </h1>
                <div class="">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Penugasan Laporan Pengaduan
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
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Korban</th>
                                <th>Jenis Kasus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $index => $laporan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $laporan->pelapor ? $laporan->korban->nama_lengkap : 'Anonim' }}</td>
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
                                        <button class="btn btn-primary btn-sm btnPenugasan" data-id="{{ $laporan->id }}">
                                            penugasan
                                        </button>
                                        <button class="btn btn-primary btn-sm btnDetail" data-id="{{ $laporan->id }}"
                                            data-pelapor="{{ $laporan->pelapor->name ?? 'Anonim' }}"
                                            data-jenis="{{ $laporan->jenis_kasus }}"
                                            data-deskripsi="{{ $laporan->kronologi }}"
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


    </div>
    <div class="modal fade" id="modalPenugasan" tabindex="-1" aria-labelledby="modalPenugasanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPenugasanLabel">Penugasan Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPenugasan" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="laporan_id" id="laporan_id">

                        <div class="mb-3">
                            <label for="kader_id" class="form-label">Pilih Kader</label>
                            <select class="form-select" name="kader_id" id="kader_id" required>
                                <option value="">-- Pilih Kader --</option>
                                @foreach ($kaders as $kader)
                                    <option value="{{ $kader->id }}">{{ $kader->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                            <select class="form-select" name="tindak_lanjut" id="tindak_lanjut" required>
                                <option value="pendampingan">Pendampingan</option>
                                <option value="kunjungan">Kunjungan</option>
                                <option value="konsultasi">Konsultasi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        {{-- input tambahan yang muncul saat pilih "Lainnya" --}}
                        <div class="mb-3 d-none" id="lainnyaInputWrapper">
                            <label for="tindak_lanjut_lainnya" class="form-label">Tindak Lanjut Lainnya</label>
                            <input type="text" class="form-control" name="tindak_lanjut_lainnya"
                                id="tindak_lanjut_lainnya" placeholder="Isi tindak lanjut lainnya...">
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" rows="3" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Penugasan</button>
                    </div>
                </form>

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
            $('#laporanTable').DataTable({
                responsive: true,
                autoWidth: false, // biar ngikutin 100%

            });

            $(document).on('click', '.btnPenugasan', function() {
                let id = $(this).data('id');
                $('#laporan_id').val(id);
                $('#modalPenugasan').modal('show');
            });

            $('#tindak_lanjut').on('change', function() {
                if ($(this).val() === 'lainnya') {
                    $('#lainnyaInputWrapper').removeClass('d-none'); // tampilkan
                    $('#tindak_lanjut_lainnya').attr('required', true);
                } else {
                    $('#lainnyaInputWrapper').addClass('d-none'); // sembunyikan
                    $('#tindak_lanjut_lainnya').val('').attr('required', false);
                }
            });

            $('#formPenugasan').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('admin.laporan.penugasan.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Penugasan berhasil disimpan');
                        $('#modalPenugasan').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menyimpan penugasan');
                    }
                });
            });

            $(document).on('click', '.btnDetail', function() {
                let id = $(this).data('id');
                $('#laporanId').val(id);

                $('#detailPelapor').text($(this).data('pelapor'));
                $('#detailJenis').text($(this).data('jenis'));
                $('#detailDeskripsi').text($(this).data('deskripsi'));
                $('#detailLokasi').text($(this).data('alamat'));
                $('#detailStatus').text($(this).data('status'));

                let bukti = $(this).data('bukti');
                if (bukti) {
                    $('#detailBukti').html('<img src="' + bukti + '" class="img-fluid rounded">');
                } else {
                    $('#detailBukti').text('Tidak ada bukti');
                }

                // buka modal
                var modal = new bootstrap.Modal(document.getElementById('modalDetail'));
                modal.show();
            });
        });
    </script>
@endpush
