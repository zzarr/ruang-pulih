@extends('layout.app')
@section('title', 'Konsultasi Proses')
@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <!-- Kolom daftar konsultasi -->
            <div class="col-md-4 mb-3 mt-5">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Daftar Konsultasi</h5>
                    </div>
                    <div class="list-group list-group-flush" id="listKonsultasi">
                        @forelse($konsultasi as $item)
                            @if ($item->status === 'proses')
                                <a href="#" class="list-group-item list-group-item-action konsultasi-item"
                                    data-id="{{ $item->id }}">
                                    <strong>
                                        Pasien:
                                        {{ $item->laporan ? $item->laporan->korban->nama_lengkap ?? 'Korban' : $item->user->name ?? 'User' }}
                                    </strong><br>
                                    <small>Status: {{ ucfirst($item->status) }}</small>
                                </a>
                            @endif
                        @empty
                            <div class="p-3 text-muted">Belum ada konsultasi</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Kolom room chat -->
            <div class="col-md-8">
                <div class="card h-100" id="chatContainer">
                    <div class="p-5 text-center text-muted" id="chatPlaceholder">
                        Pilih konsultasi dari daftar untuk mulai sesi chat.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Jitsi Meet -->
    <div class="modal fade" id="jitsiModal" tabindex="-1" aria-labelledby="jitsiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sesi Meet Online</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="destroyJitsi()"></button>
                </div>
                <div class="modal-body p-0">
                    <div id="jitsi-container" style="height: 600px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTutupSesi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">Asesment Konsultasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form id="formTutupSesi">
                    @csrf
                    <input type="hidden" name="konsultasi_id" id="konsultasiId">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Catatan Konselor</label>
                            <textarea class="form-control" name="catatan" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan & Tutup Sesi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('css')
    <style>
        .chat-msg {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 16px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .chat-body {
            background: #f9f9f9;
        }

        .chat-time {
            font-size: 11px;
            display: block;
            margin-top: 2px;
        }

        .media-body.reverse {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .media-img img.thumb-sm {
            width: 35px;
            height: 35px;
        }
    </style>
@endpush

@push('js')
    <script src="https://meet.jit.si/external_api.js"></script>

    <script>
        $(document).ready(function() {
            $('.konsultasi-item').click(function(e) {
                e.preventDefault();
                var konsultasiId = $(this).data('id');

                // Highlight item yang dipilih
                $('.konsultasi-item').removeClass('active');
                $(this).addClass('active');

                // AJAX untuk load chat
                $.ajax({
                    url: '/konselor/konsultasi/' + konsultasiId + '/chat-ajax',
                    type: 'GET',
                    success: function(res) {
                        $('#chatContainer').html(res);
                        // Scroll ke bawah otomatis
                        var chatBody = $('#chatBody');
                        chatBody.scrollTop(chatBody[0].scrollHeight);
                    },
                    error: function() {
                        alert('Gagal memuat chat.');
                    }
                });
            });

            let api = null;

            // ✅ Fungsi untuk kirim link ke chat
            window.startMeet = function(konsultasiId) {
                let meetLink = `https://meet.jit.si/konsultasi-${konsultasiId}`;

                $.ajax({
                    url: `/konselor/konsultasi/${konsultasiId}/send`,
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        konsultasi_id: konsultasiId,
                        pesan: `Yuk join meet: <a href="#" class="open-meet" data-id="${konsultasiId}" data-link="${meetLink}">${meetLink}</a>`,
                        pengirim_id: "{{ auth()->id() }}",
                    },
                    success: function(res) {
                        $('#chatBody').append(`
                    <div class="d-flex justify-content-end mb-3">
                        <div class="p-2 rounded-2 bg-primary text-white">
                            Yuk join meet: <a href="#" class="open-meet" data-id="${konsultasiId}" data-link="${meetLink}">${meetLink}</a>
                            <br>
                            <small class="text-muted">baru saja</small>
                        </div>
                    </div>
                `);
                        $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
                    }
                });
            }

            // ✅ Saat link di chat diklik → buka modal
            $(document).on("click", ".open-meet", function(e) {
                e.preventDefault();
                let konsultasiId = $(this).data("id");
                let meetLink = $(this).data("link");

                $('#jitsiModal').modal('show');

                setTimeout(() => {
                    const domain = "meet.jit.si";
                    const options = {
                        roomName: `konsultasi-${konsultasiId}`,
                        width: "100%",
                        height: 600,
                        parentNode: document.querySelector('#jitsi-container'),
                    };
                    api = new JitsiMeetExternalAPI(domain, options);
                }, 300);
            });

            window.destroyJitsi = function() {
                if (api) {
                    api.dispose();
                    api = null;
                }
                document.querySelector('#jitsi-container').innerHTML = "";
            }

            // Tombol untuk buat link meet (tidak langsung buka modal)
            $(document).on('click', '.btn-meet', function() {
                let konsultasiId = $(this).data('id');
                startMeet(konsultasiId);
            });

            $(document).on('click', '.btn-tutup-sesi', function() {
                let id = $(this).data('id');
                $('#konsultasiId').val(id);

                let modalTutup = new bootstrap.Modal(document.getElementById('modalTutupSesi'));
                modalTutup.show();
            });

            $('#formTutupSesi').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('konselor.konsultasi.tutup-sesi') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        if (res.success) {
                            alert(res.message);
                            $('#modalTutupSesi').modal('hide');
                            location.reload(); // reload tabel/halaman
                        }
                    },
                    error: function() {
                        alert('Gagal menutup sesi!');
                    }
                });
            });


        });
    </script>
@endpush
