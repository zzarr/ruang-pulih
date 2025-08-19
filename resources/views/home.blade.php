@extends('layout.app2')
@section('content')
    <!-- Start Banner Area -->
    <div class="main-banner-area-two">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="main-banner-content">
                                <img src="" alt="" srcset="">
                                <h1>Dengar, Dukung, dan Lindungi </h1>

                                <div class="banner-btn">
                                    <a href="" class="default-btn" data-bs-toggle="modal"
                                        data-bs-target="#modalKonseling">Konseling</a>
                                    <a href="" class="optional-btn" data-bs-toggle="modal"
                                        data-bs-target="#modalLaporan">Pengaduan </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">

                            <img src="logo/banner.png" class="wow zoomIn" data-wow-delay="0.6s" alt="image">

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="default-shape">
            <div class="shape-1">
                <img src="assets/img/shape/4.png" alt="image">
            </div>

            <div class="shape-2 rotateme">
                <img src="assets/img/shape/5.svg" alt="image">
            </div>

            <div class="shape-3">
                <img src="assets/img/shape/6.svg" alt="image">
            </div>

            <div class="shape-4">
                <img src="assets/img/shape/7.png" alt="image">
            </div>

            <div class="shape-5">
                <img src="assets/img/shape/8.png" alt="image">
            </div>
        </div>
    </div>
    <!-- End Banner Area -->

    <div class="ashiapp">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLaporan">
            <div class="info-panel">
                <img src="{{ asset('img/icon/icon22.png') }}" alt="ChatDokter">
                <h4>PENGADUAN KEKERASAN</h4>

            </div>
        </a>

        <a href="#" class="js-signin-modal-trigger" id="btnKonsul">
            <div class="info-panel">
                <img src="{{ asset('img/icon/icon11.png') }}" alt="High Res">
                <h4>CHAT KONSELOR</h4>
            </div>
        </a>
    </div>
    <section class="support-section ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <!-- Gambar ilustrasi -->
                <div class="col-lg-6">
                    <div class="support-image">
                        <img src="assets/img/konsul.png" alt="Dukung & Lindungi">
                    </div>
                </div>

                <!-- Konten Ajakan -->
                <div class="col-lg-6">
                    <!-- Ajakan Konseling -->
                    <div class="support-content mb-4">
                        <div class="icon">
                            <i class="flaticon-chat"></i>
                        </div>
                        <h3>Konseling Aman dan Rahasia</h3>
                        <p>Bicarakan masalahmu dengan konselor profesional secara aman dan rahasia. Dapatkan dukungan
                            emosional kapan saja.</p>

                    </div>

                    <!-- Ajakan Pengaduan Kekerasan -->
                    <div class="support-content mb-4">
                        <div class="icon">
                            <i class="flaticon-report"></i>
                        </div>
                        <h3>Laporkan Kekerasan Secara Aman</h3>
                        <p>Laporkan kejadian kekerasan secara anonim dan aman. Laporan akan ditindaklanjuti oleh tim
                            profesional.</p>

                    </div>

                    <!-- Info tambahan / tips singkat -->
                    <div class="support-content">
                        <div class="icon">
                            <i class="flaticon-info"></i>
                        </div>
                        <h3>Privasi & Keamanan</h3>
                        <p>Data pribadi Anda aman dan tidak akan dibagikan. Fokus kami adalah melindungi dan mendukung
                            korban.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="footer-section pt-100 pb-70">
        <div class="container">
            <div class="row">
                <!-- About Us -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-footer-widget">
                        <div class="footer-heading">
                            <h3>Tentang Kami</h3>
                        </div>
                        <p>-</p>
                        <ul class="footer-social">
                            <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                            <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                            <li><a href="#"><i class="flaticon-pinterest"></i></a></li>
                            <li><a href="#"><i class="flaticon-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-footer-widget">
                        <div class="footer-heading">
                            <h3>Kontak</h3>
                        </div>

                        <div class="footer-info-contact mb-3">
                            <i class="flaticon-phone-call"></i>
                            <h3>Phone</h3>
                            <span><a href="tel:+62895606607770">+62 895-6066-07770</a></span>
                        </div>

                        <div class="footer-info-contact mb-3">
                            <i class="flaticon-envelope"></i>
                            <h3>Email</h3>

                        </div>

                        <div class="footer-info-contact">
                            <i class="flaticon-pin"></i>
                            <h3>Alamat</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pengaduan-modal')
    @include('konsul-modal')
@endsection
