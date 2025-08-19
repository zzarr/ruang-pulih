<aside class="app-sidebar sticky" id="sidebar">
    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <!-- <a href="index.html" class="header-logo">
            <img src="../assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
            <img src="../assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
            <img src="../assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-dark">
            <img src="../assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
            <img src="../assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white">
            <img src="../assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
        </a> -->
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px 0px -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px 0px 80px;">
                            <!-- Start::nav -->
                            <nav class="main-menu-container nav nav-pills flex-column sub-open active">
                                <div class="slide-left active d-none" id="slide-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                    </svg>
                                </div>
                                <ul class="main-menu active" style="margin-left: 0px; margin-right: 0px;">
                                    <!-- Start::slide__category -->
                                    <li class="slide__category">
                                        <span class="category-name">Main</span>
                                    </li>
                                    <!-- End::slide__category -->

                                    <!-- Start::slide -->
                                    <li class="slide active">
                                        <a href="index.html" class="side-menu__item active">
                                            <i class="fe fe-home side-menu__icon"></i>
                                            <span class="side-menu__label">Dashboard</span>
                                        </a>
                                    </li>

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('petugas.verifikasi') }}" class="side-menu__item">
                                            <i class="fe fe-grid side-menu__icon"></i>
                                            <span class="side-menu__label">Daftar Laporan</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('petugas.laporan.terverifikasi') }}" class="side-menu__item">
                                            <i class="fe fe-grid side-menu__icon"></i>
                                            <span class="side-menu__label">Laporan Terverifikasi</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- End::slide -->
                                    <!-- Start::slide__category -->

                                </ul>
                                <div class="slide-right d-none" id="slide-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                        </path>
                                    </svg>
                                </div>
                            </nav>
                            <!-- End::nav -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1040px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);">
            </div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 438px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
</aside>
