<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('logo.png') }}?v=1" type="image/svg+xml">

    <title>Ruang Pulih - @yield('title')</title>

    @include('components.header-css')
    @stack('css')

</head>

<body>
    <!-- Loader -->
    <div id="loader">
        <img src="/dist/assets/images/media/loader.svg" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="index.html" class="header-logo">
                                <img src="{{ asset('/assets/images/brand-logos/desktop-logo.png') }}" alt="logo"
                                    class="desktop-logo">
                                <img src="{{ asset('/assets/images/brand-logos/toggle-logo.png') }}" alt="logo"
                                    class="toggle-logo">
                                <img src="{{ asset('/assets/images/brand-logos/desktop-white.png') }}" alt="logo"
                                    class="desktop-dark">
                                <img src="{{ asset('/assets/images/brand-logos/toggle-dark.png') }}" alt="logo"
                                    class="toggle-dark">
                                <img src="{{ asset('/assets/images/brand-logos/desktop-white.png') }}" alt="logo"
                                    class="desktop-white">
                                <img src="{{ asset('/assets/images/brand-logos/toggle-white.png') }}" alt="logo"
                                    class="toggle-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle mx-0 my-auto"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->
                    <!-- Start::header-element -->

                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">
                    <!-- Start::header-element -->



                    <!-- Start::header-element -->
                    <div class="header-element profile-1">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="#" class=" dropdown-toggle leading-none d-flex px-1" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img src="{{ asset('/assets/images/faces/9.jpg') }}" alt="img"
                                        class="rounded-circle avatar  profile-user brround cover-image">
                                </div>
                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            <li><a class="dropdown-item d-flex" href="profile.html"><i
                                        class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex">
                                        <i class="ti ti-logout fs-18 me-2 op-7"></i>Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- End::header-element -->
                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>

        @include('components.sidebar')
        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid mb-4">
                @yield('content')
            </div>
        </div>
        <footer class="footer mt-auto py-3 bg-white text-center mt-5">
            <div class="container">
                <span class="text-muted"> Copyright © <span id="year">2025</span> <a href="javascript:void(0);"
                        class="text-dark fw-semibold">Ruang Pulih</a>.
                </span>
            </div>
        </footer>
    </div>

    @include('components.footer-js')

    @stack('js')
</body>

</html>
