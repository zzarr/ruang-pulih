<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ruang Pulih</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/svg+xml">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <!-- Owl Default CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <!-- Owl Magnific CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/boxicons.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css ') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <!-- Odometer CSS-->
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.min.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- RTL CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">


    <style>
        .ashiapp {
            position: relative;
            margin-top: -80px;
            /* naik ke area banner */
            z-index: 10;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            /* supaya responsif di HP */
        }

        .ashiapp a {
            text-decoration: none;
        }

        .ashiapp .info-panel {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 220px;
            /* lebar tetap */
            min-height: 230px;
            /* tinggi minimum supaya seragam */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* isi rata tengah vertikal */
            cursor: pointer;
        }

        .ashiapp .info-panel img {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
        }

        .ashiapp .info-panel:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        /* 📱 Responsive untuk mobile */
        @media (max-width: 768px) {
            .ashiapp {
                margin-top: 30px;
                /* hilangkan naik */
                z-index: 10;
                /* tetap di atas banner */
            }
        }
    </style>
</head>

<body>

    <!-- Start Navbar Area -->
    <div class="navbar-area">
        <div class="fria-responsive-nav">
            <div class="container">
                <div class="fria-responsive-menu">
                    <div class="logo">
                        <a href="index.html">
                            <img src="logo.png" class="black-logo" alt="image" width="70" height="70">
                            <img src="assets/img/logo-2.png" class="white-logo" alt="image">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="fria-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="index.html">
                        <img src="logo.png" class="black-logo" alt="image" width="70" height="70">
                        <img src="assets/img/logo-2.png" class="white-logo" alt="image">
                    </a>

                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    Home
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="about.html" class="nav-link">
                                    About
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Konsultasi
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @forelse($konsultasis as $item)
                                        <li class="nav-item">
                                            <a href="{{ route('konsultasi.show', $item->id) }}"
                                                class="nav-link konsultasi-item" data-id="{{ $item->id }}">
                                                <div class="d-flex justify-content-between">
                                                    <strong>{{ $item->konselor->name ?? 'Konselor tidak diketahui' }}</strong>
                                                    <span
                                                        class="badge 
                            @if ($item->status == 'proses') bg-primary 
                            @elseif($item->status == 'Done') bg-success 
                            @else bg-secondary @endif text-white">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </div>
                                                <div class="text-muted">
                                                    {{ $item->topik ?? 'Topik tidak tersedia' }}
                                                </div>
                                                <div class="small text-secondary">
                                                    {{ $item->created_at->format('d M Y H:i') }}
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                        <li class="nav-item">
                                            <a href="#" class="nav-link text-muted">
                                                Belum ada konsultasi
                                            </a>
                                        </li>
                                    @endforelse
                                </ul>
                            </li>

                        </ul>

                        <div class="others-options d-flex align-items-center">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary me-2">Masuk</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">Daftar</a>
                            @endguest

                            @auth
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary">Keluar</button>
                                </form>
                                <ul class="dropdown-menu">
                                    <li class="head text-light hijau">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <span>Notifications {{ $konsultasis->count() }}</span>
                                                <a href="" class="float-right text-light">Mark all as read</a>
                                            </div>
                                        </div>
                                    </li>

                                    <div class="bungkus-notif">
                                        @forelse ($konsultasis as $k)
                                            <li class="notification-box">
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-3 col-3 text-center">
                                                        <img src="{{ $k->konselor->profile_photo ?? '/img/doctor1.jpg' }}"
                                                            class="img_notif">
                                                    </div>
                                                    <div class="col-lg-8 col-sm-8 col-8">
                                                        <strong class="text-hijau">
                                                            {{ $k->konselor->name ?? 'Konselor' }}
                                                        </strong>
                                                        &nbsp;
                                                        <span class="badge badge-primary">{{ ucfirst($k->status) }}</span>

                                                        <div class="spoiler_chat">
                                                            {{ $k->catatan ?? 'Tidak ada catatan' }}
                                                        </div>

                                                        <small class="text-warning">
                                                            {{ $k->created_at->diffForHumans() }}
                                                        </small>

                                                        <a href="" target="_blank">
                                                            <button type="button"
                                                                class="btn tombol hijau putih btn-sm float-right">
                                                                Lihat Konsul
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="notification-box text-center p-2">
                                                <em>Tidak ada notifikasi</em>
                                            </li>
                                        @endforelse
                                    </div>

                                    <li class="footer-notif hijau text-center">
                                        <a href="" class="text-light">View All</a>
                                    </li>
                                </ul>

                            @endauth
                        </div>

                    </div>
                </nav>

            </div>
        </div>
    </div>

    @yield('content')
    <!-- Jquery Slim JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js ') }}"></script>
    <!-- Meanmenu JS -->
    <script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific JS -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Appear JS -->
    <script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
    <!-- Odometer JS -->
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <!-- Form Ajaxchimp JS -->
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Form Validator JS -->
    <script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
    <!-- Contact JS -->
    <script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // cek login dan role
            var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
            var userRole = "{{ auth()->check() ? auth()->user()->role : '' }}";

            $('#btnKonsul').on('click', function(e) {
                e.preventDefault();

                if (!isLoggedIn || userRole !== 'user') {
                    alert("Anda harus masuk sebagai user terlebih dahulu.");
                    window.location.href = "{{ route('login') }}";
                    return;
                }

                // jika login dan role user, tampilkan modal
                $('#modalKonsul').modal('show');
            });

            // submit form via AJAX
            $('#formKonsul').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('konsultasi.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        topik: $('#topik').val(),
                    },
                    success: function(res) {
                        alert('Konseling berhasil dibuat!');
                        $('#modalKonsul').modal('hide');
                        $('#formKonsul')[0].reset();
                    },
                    error: function(err) {
                        alert('Terjadi kesalahan!');
                    }
                });
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
                        Notiflix.Notify.success("Laporan berhasil disimpan!");
                        $("#laporanForm")[0].reset();
                        $('#modalLaporan').modal('hide');
                        currentStep = 0;
                        updateStepDisplay();
                    },
                    error: function(xhr) {
                        Notiflix.Notify.failure("Terjadi kesalahan saat menyimpan data!");
                        console.log(xhr.responseText);
                    }
                });
            });

        });
    </script>

</body>

</html>
