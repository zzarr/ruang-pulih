@extends('layout.app') {{-- Ganti dengan layout kamu jika berbeda --}}
@section('title', 'Buat Laporan Baru')

@section('content')
    <div class="container-fluid mb-5">
        {{-- Header --}}
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="">
                <h1 class="page-title fw-semibold fs-20 mb-0">
                    Dashboard
                </h1>
                <div class="">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Buat Laporan Baru
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container my-2">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Pengaduan Kekerasan</h5>
                </div>

                <div class="card-body">
                    <!-- Progress Bar -->
                    <div class="px-4 pt-3">
                        <div class="progress" style="height: 6px;">
                            <div id="progressBar" class="progress-bar bg-primary" style="width: 25%;"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <small>Data Laporan</small>
                            <small>Pelapor</small>
                            <small>Terlapor</small>
                            <small>Korban</small>
                        </div>
                    </div>

                    <form id="laporanForm" enctype="multipart/form-data">
                        @csrf

                        <div class="step" id="step-0">
                            @include('form-step-laporan')
                        </div>
                        <div class="step d-none" id="step-1">
                            @include('form-step-pelapor')
                        </div>
                        <div class="step d-none" id="step-2">
                            @include('form-step-terlapor')
                        </div>
                        <div class="step d-none" id="step-3">
                            @include('form-step-korban')
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevStep">Sebelumnya</button>
                            <button type="button" class="btn btn-primary" id="nextStep">Berikutnya</button>
                            <button type="submit" class="btn btn-success" id="submitBtn">Kirim Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <!-- Notiflix CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/dist/notiflix-3.2.7.min.css" />
@endpush
@push('js')
    <!-- Notiflix JS -->
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/dist/notiflix-aio-3.2.7.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $steps = $('.step');
            var $progressBar = $('#progressBar');
            var $prevBtn = $('#prevStep');
            var $nextBtn = $('#nextStep');
            var $submitBtn = $('#submitBtn');
            var currentStep = 0;
            var totalSteps = $steps.length;

            function updateStepDisplay() {
                $steps.addClass('d-none').eq(currentStep).removeClass('d-none');
                $prevBtn.toggle(currentStep > 0);
                $nextBtn.toggle(currentStep < totalSteps - 1);
                $submitBtn.toggle(currentStep === totalSteps - 1);

                var progressPercent = ((currentStep + 1) / totalSteps) * 100;
                $progressBar.css('width', progressPercent + '%');
            }


            $prevBtn.on('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    updateStepDisplay();
                }
            });

            $nextBtn.on('click', function() {
                if (currentStep < totalSteps - 1) {
                    currentStep++;
                    updateStepDisplay();
                }
            });

            $('#modalLaporan').on('show.bs.modal', function() {
                currentStep = 0;
                updateStepDisplay();
                $("#laporanForm")[0].reset();
                $("#inputKasusLainnya").hide().val("");
            });

            updateStepDisplay();

            $('#kasusLainnya').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#inputKasusLainnya').slideDown().focus();
                } else {
                    $('#inputKasusLainnya').slideUp().val('');
                }
            });

            $("#submitBtn").on("click", function(e) {
                e.preventDefault();

                let formData = new FormData($("#laporanForm")[0]); // ambil semua input termasuk file

                $.ajax({
                    url: "/pelaporan/store",
                    type: "POST",
                    data: formData,
                    processData: false, // penting: jangan ubah FormData jadi string
                    contentType: false, // penting: biar otomatis multipart/form-data
                    success: function(response) {
                        Notiflix.Notify.success('Laporan berhasil disimpan!', {
                            width: '280px', // lebar popup
                            position: 'right-top', // posisi di layar
                            distance: '10px', // jarak dari tepi
                            timeout: 3000, // durasi tampil (ms)
                            clickToClose: true, // bisa klik untuk tutup
                            fontSize: '16px',
                            cssAnimationStyle: 'fade' // animasi masuk/keluar
                        });

                        // reset form
                        $("#laporanForm")[0].reset();

                        // reset wizard step
                        currentStep = 0;
                        updateStepDisplay();

                    },

                    error: function(xhr) {
                        Notiflix.Notify.failure('Terjadi kesalahan saat menyimpan data!', {
                            width: '280px',
                            position: 'right-top',
                            distance: '10px',
                            timeout: 4000,
                            clickToClose: true,
                            fontSize: '16px',
                            cssAnimationStyle: 'fade'
                        });

                        console.log(xhr.responseText);
                    }

                });
            });
        });
    </script>
@endpush
