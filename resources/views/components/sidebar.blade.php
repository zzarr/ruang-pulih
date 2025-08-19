<aside class="app-sidebar sticky" id="sidebar">
    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo">
            <img src="{{ asset('/logo/logo.png') }}" alt="logo" class="desktop-logo" width="60" height="60">
            <img src="{{ asset('/logo/logo.png') }}" alt="logo" class="toggle-logo" width="60" height="60">
            <img src="{{ asset('/assets/images/brand-logos/desktop-white.png') }}" alt="logo" class="desktop-dark">
            <img src="{{ asset('/assets/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
            <img src="{{ asset('/assets/images/brand-logos/desktop-white.png') }}" alt="logo" class="desktop-white">
            <img src="{{ asset('/assets/images/brand-logos/toggle-white.png') }}" alt="logo" class="toggle-white">
        </a>
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

                                    {{-- Menu khusus Admin --}}
                                    @if (Auth::check() && Auth::user()->role === 'admin')
                                        <li class="slide {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                            <a href="{{ route('admin.dashboard') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                                <i class="fe fe-home side-menu__icon"></i>
                                                <span class="side-menu__label">Dashboard</span>
                                            </a>
                                        </li>

                                        <li
                                            class="slide {{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
                                            <a href="{{ route('admin.laporan.index') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
                                                <i class="fe fe-grid side-menu__icon"></i>
                                                <span class="side-menu__label">Kelola Laporan</span>
                                            </a>
                                        </li>

                                        <li
                                            class="slide {{ request()->routeIs('admin.laporan.penugasan') ? 'active' : '' }}">
                                            <a href="{{ route('admin.laporan.penugasan') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.laporan.penugasan') ? 'active' : '' }}">
                                                <i class="fe fe-check-square side-menu__icon"></i>
                                                <span class="side-menu__label">Penugasan</span>
                                            </a>
                                        </li>

                                        {{-- 🔹 Tambahan Admin --}}
                                        <li
                                            class="slide {{ request()->routeIs('admin.monitoring.tindak') ? 'active' : '' }}">
                                            <a href="{{ route('admin.monitoring.tindak') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.monitoring.tindak') ? 'active' : '' }}">
                                                <i class="fe fe-message-square side-menu__icon"></i>
                                                <span class="side-menu__label">Monitoring Tindak Lanjut</span>
                                            </a>
                                        </li>
                                        <li
                                            class="slide {{ request()->routeIs('admin.monitoring.konsultasi') ? 'active' : '' }}">
                                            <a href="{{ route('admin.monitoring.konsultasi') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.monitoring.konsultasi') ? 'active' : '' }}">
                                                <i class="fe fe-message-square side-menu__icon"></i>
                                                <span class="side-menu__label">Monitoring Konsultasi</span>
                                            </a>
                                        </li>


                                        <li class="slide {{ request()->routeIs('admin.akun.index') ? 'active' : '' }}">
                                            <a href="{{ route('admin.akun.index') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.akun.index') ? 'active' : '' }}">
                                                <i class="fe fe-users side-menu__icon"></i>
                                                <span class="side-menu__label">Kelola User</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Menu khusus Konselor --}}
                                    @if (Auth::check() && Auth::user()->role === 'konselor')
                                        <li
                                            class="slide {{ request()->routeIs('konselor.dashboard') ? 'active' : '' }}">
                                            <a href="" class="side-menu__item">
                                                <i class="fe fe-home side-menu__icon"></i>
                                                <span class="side-menu__label">Dashboard</span>
                                            </a>
                                        </li>

                                        <li class="slide">
                                            <a href="{{ route('konselor.konsultasi.index') }}" class="side-menu__item">
                                                <i class="fe fe-list side-menu__icon"></i>
                                                <span class="side-menu__label">Daftar Konsultasi</span>
                                            </a>
                                        </li>

                                        <li class="slide">
                                            <a href="" class="side-menu__item">
                                                <i class="fe fe-clock side-menu__icon"></i>
                                                <span class="side-menu__label">Konsultasi Pending</span>
                                            </a>
                                        </li>

                                        <li
                                            class="slide {{ request()->routeIs('konselor.konsultasi.chat') ? 'active' : '' }}">
                                            <a href="{{ route('konselor.konsultasi.chat') }}"
                                                class="side-menu__item {{ request()->routeIs('konselor.konsultasi.chat') ? 'active' : '' }}">
                                                <i class="fe fe-activity side-menu__icon"></i>
                                                <span class="side-menu__label">Konsultasi Proses</span>
                                            </a>
                                        </li>

                                        <li class="slide">
                                            <a href="" class="side-menu__item">
                                                <i class="fe fe-check-circle side-menu__icon"></i>
                                                <span class="side-menu__label">Konsultasi Selesai</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Menu khusus Kader --}}
                                    @if (Auth::check() && Auth::user()->role === 'kader')
                                        <li class="slide {{ request()->routeIs('kader.dashboard') ? 'active' : '' }}">
                                            <a href="{{ route('kader.dashboard') }}"
                                                class="side-menu__item {{ request()->routeIs('kader.dashboard') ? 'active' : '' }}">
                                                <i class="fe fe-home side-menu__icon"></i>
                                                <span class="side-menu__label">Dashboard</span>
                                            </a>
                                        </li>

                                        <li
                                            class="slide {{ request()->routeIs('kader.laporan.create') ? 'active' : '' }}">
                                            <a href="{{ route('kader.laporan.create') }}"
                                                class="side-menu__item {{ request()->routeIs('kader.laporan.create') ? 'active' : '' }}">
                                                <i class="fe fe-file-text side-menu__icon"></i>
                                                <span class="side-menu__label">Buat Laporan</span>
                                            </a>
                                        </li>

                                        <li
                                            class="slide {{ request()->routeIs('kader.tugas.penanganan') ? 'active' : '' }}">
                                            <a href="{{ route('kader.tugas.penanganan') }}"
                                                class="side-menu__item {{ request()->routeIs('kader.tugas.penanganan') ? 'active' : '' }}">
                                                <i class="fe fe-check-circle side-menu__icon"></i>
                                                <span class="side-menu__label">Tugas Penanganan</span>
                                            </a>
                                        </li>

                                        {{-- 🔹 Tambahan Kader --}}
                                        <li
                                            class="slide {{ request()->routeIs('kader.konsultasi.korban') ? 'active' : '' }}">
                                            {{-- Ganti route sesuai dengan route yang ada --}}
                                            <a href="{{ route('kader.konsultasi.korban') }}"
                                                class="side-menu__item {{ request()->routeIs('kader.konsultasi.korban') ? 'active' : '' }}">
                                                <i class="fe fe-message-square side-menu__icon"></i>
                                                <span class="side-menu__label">Konsultasi Korban</span>
                                            </a>
                                        </li>
                                    @endif


                                    {{-- Menu khusus User Anonim (kalau login anonim) --}}
                                    @if (Auth::check() && Auth::user()->role === 'user')
                                        <li class="slide">
                                            <a href="/home" class="side-menu__item">
                                                <i class="fe fe-home side-menu__icon"></i>
                                                <span class="side-menu__label">Kembali ke beranda</span>
                                            </a>
                                        </li>
                                        <li class="slide {{ request()->routeIs('konsultasi.show') ? 'active' : '' }}">
                                            <a href=""
                                                class="side-menu__item {{ request()->routeIs('konsultasi.show') ? 'active' : '' }}">
                                                <i class="fe fe-message-square side-menu__icon"></i>
                                                <span class="side-menu__label">Chat</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="slide-right d-none" id="slide-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                                        height="24" viewBox="0 0 24 24">
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
            <div class="simplebar-scrollbar"
                style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);">
            </div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 438px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
</aside>
