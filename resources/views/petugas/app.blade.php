<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('pelaporan.components.header-css')

</head>

<body>
    <!-- Loader -->
    <div id="loader">
        <img src="../assets/images/media/loader.svg" alt="">
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
                                <img src="../assets/images/brand-logos/desktop-logo.png" alt="logo"
                                    class="desktop-logo">
                                <img src="../assets/images/brand-logos/toggle-logo.png" alt="logo"
                                    class="toggle-logo">
                                <img src="../assets/images/brand-logos/desktop-white.png" alt="logo"
                                    class="desktop-dark">
                                <img src="../assets/images/brand-logos/toggle-dark.png" alt="logo"
                                    class="toggle-dark">
                                <img src="../assets/images/brand-logos/desktop-white.png" alt="logo"
                                    class="desktop-white">
                                <img src="../assets/images/brand-logos/toggle-white.png" alt="logo"
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
                    <div class="header-element header-search">
                        <!-- Start::header-link -->
                        <!-- <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="bx bx-search-alt-2 header-link-icon"></i>
                        </a> -->
                        <div class="main-header-search ms-3 d-none d-lg-block my-auto">
                            <input class="form-control" placeholder="Search for anything..." type="search"> <button
                                class="btn"><i class="fe fe-search" aria-hidden="true"></i></button>
                        </div>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <!-- Start::header-element -->
                    <div class="header-element country-selector">


                        <!-- Start::header-element -->
                        <div class="header-element header-search d-block d-lg-none">
                            <!-- Start::header-link -->
                            <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                                <i class="ti ti-search header-link-icon"></i>
                            </a>
                            <!-- End::header-link -->
                        </div>
                        <!-- End::header-element -->

                        <!-- Start::header-element -->
                        <div class="header-element header-theme-mode">
                            <!-- Start::header-link|layout-setting -->
                            <a href="javascript:void(0);" class="header-link layout-setting">
                                <span class="light-layout">
                                    <!-- Start::header-link-icon -->
                                    <i class="fe fe-moonfe fe-moon header-link-icon align-middle"></i>
                                    <!-- End::header-link-icon -->
                                </span>
                                <span class="dark-layout">
                                    <!-- Start::header-link-icon -->
                                    <i class="fe fe-sun header-link-icon"></i>
                                    <!-- End::header-link-icon -->
                                </span>
                            </a>
                            <!-- End::header-link|layout-setting -->
                        </div>
                        <!-- End::header-element -->

                        <!-- Start::header-element -->
                        <div class="header-element header-fullscreen">
                            <!-- Start::header-link -->
                            <a onclick="openFullscreen();" href="#" class="header-link">
                                <i class="fe fe-maximize full-screen-open header-link-icon"></i>
                                <i class="fe fe-minimize full-screen-close header-link-icon d-none"></i>
                            </a>
                            <!-- End::header-link -->
                        </div>
                        <!-- End::header-element -->

                        <!-- Start::header-element -->
                        <div class="header-element notifications-dropdown">
                            <!-- Start::header-link|dropdown-toggle -->
                            <a href="javascript:void(0);" class="header-link dropdown-toggle"
                                data-bs-auto-close="outside" data-bs-toggle="dropdown">
                                <i class="fe fe-bell header-link-icon"></i>
                                <span class="pulse-success"></span>
                            </a>
                            <!-- End::header-link|dropdown-toggle -->
                            <!-- Start::main-header-dropdown -->
                            <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                                data-popper-placement="none">
                                <div class="p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="mb-0 fs-17 fw-semibold">Notifications</p>
                                        <span class="badge bg-success fw-normal" id="notifiation-data">5 Unread</span>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <ul class="list-unstyled mb-0" id="header-notification-scroll">
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-start">
                                            <div class="pe-2">
                                                <span
                                                    class="avatar avatar-md bg-primary-gradient box-shadow-primary avatar-rounded"><i
                                                        class="ri-chat-4-line fs-18"></i></span>
                                            </div>
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-0 fw-semibold"><a href="default-chat.html">New review
                                                            received</a>
                                                    </p>
                                                    <span class="text-muted fw-normal fs-12 header-notification-text">2
                                                        hours
                                                        ago</span>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        class="min-w-fit-content text-muted me-1 dropdown-item-close2"><i
                                                            class="ti ti-x fs-16"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                <div class="p-3 empty-header-item1 border-top">
                                    <div class="d-grid">
                                        <a href="default-chat.html" class="btn text-muted p-0 border-0">View all
                                            Notification</a>
                                    </div>
                                </div>
                                <div class="p-5 empty-item1 d-none">
                                    <div class="text-center">
                                        <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                            <i class="ri-notification-off-line fs-2"></i>
                                        </span>
                                        <h6 class="fw-semibold mt-3">No New Notifications</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- End::main-header-dropdown -->
                        </div>
                        <!-- End::header-element -->

                        <!-- Start::header-element -->
                        <div class="header-element meassage-dropdown d-none d-xl-block">
                            <!-- Start::header-link|dropdown-toggle -->
                            <a href="javascript:void(0);" class="header-link dropdown-toggle"
                                data-bs-auto-close="outside" data-bs-toggle="dropdown">
                                <i class="fe fe-message-square header-link-icon"></i>
                                <span class="pulse-danger"></span>
                            </a>
                            <!-- End::header-link|dropdown-toggle -->
                            <!-- Start::main-header-dropdown -->
                            <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                                data-popper-placement="none">
                                <div class="p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="mb-0 fs-17 fw-semibold">You have Messages</p>
                                        <span class="badge bg-success fw-normal" id="message-data">5 Unread</span>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <ul class="list-unstyled mb-0" id="header-notification-scroll1">
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-start">
                                            <div class="pe-2">
                                                <img src="../assets/images/faces/1.jpg" alt="img"
                                                    class="rounded-circle avatar">
                                            </div>
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-0 fw-semibold"><a
                                                            href="default-chat.html">Madeleine<span
                                                                class="text-muted fs-12 fw-normal ps-1 d-inline-block">
                                                                3
                                                                hours ago </span></a>
                                                    </p>
                                                    <span
                                                        class="text-muted fw-normal fs-12 header-notification-text">Hey!
                                                        there I'
                                                        am available....</span>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        class="min-w-fit-content text-muted me-1 dropdown-item-close3"><i
                                                            class="ti ti-x fs-16"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                <div class="p-3 empty-header-item1 border-top">
                                    <div class="d-grid">
                                        <a href="default-chat.html" class="btn text-muted p-0 border-0">See all
                                            Messages</a>
                                    </div>
                                </div>
                                <div class="p-5 empty-item1 d-none">
                                    <div class="text-center">
                                        <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                            <i class="ri-notification-off-line fs-2"></i>
                                        </span>
                                        <h6 class="fw-semibold mt-3">No New Notifications</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- End::main-header-dropdown -->
                        </div>
                        <!-- End::header-element -->




                        <!-- Start::header-element -->
                        <div class="header-element profile-1">
                            <!-- Start::header-link|dropdown-toggle -->
                            <a href="#" class=" dropdown-toggle leading-none d-flex px-1"
                                id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <img src="../assets/images/faces/9.jpg" alt="img"
                                            class="rounded-circle avatar  profile-user brround cover-image">
                                    </div>
                                </div>
                            </a>
                            <!-- End::header-link|dropdown-toggle -->
                            <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                                aria-labelledby="mainHeaderProfile">
                                <li><a class="dropdown-item d-flex" href="profile.html"><i
                                            class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                                <li><a class="dropdown-item d-flex" href="email.html"><i
                                            class="ti ti-inbox fs-18 me-2 op-7"></i>Inbox <span
                                            class="badge bg-success-transparent ms-auto">25</span></a></li>
                                <li><a class="dropdown-item d-flex border-block-end" href="Timeline.html"><i
                                            class="ti ti-clipboard-check fs-18 me-2 op-7"></i>Task Manager</a></li>
                                <li><a class="dropdown-item d-flex" href="emailservices.html"><i
                                            class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Settings</a></li>
                                <li><a class="dropdown-item d-flex" href="Faq.html"><i
                                            class="ti ti-headset fs-18 me-2 op-7"></i>Support</a></li>
                                <li><a class="dropdown-item d-flex" href="login.html"><i
                                            class="ti ti-logout fs-18 me-2 op-7"></i>Log Out</a></li>
                            </ul>
                        </div>
                        <!-- End::header-element -->

                        <!-- Start::header-element -->
                        <div class="header-element d-none d-sm-block">
                            <!-- Start::header-link|switcher-icon -->
                            <a href="#" class="header-link" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvassidebar">
                                <i class="fe fe-menu header-link-icon"></i>
                            </a>
                            <!-- End::header-link|switcher-icon -->
                        </div>
                        <!-- End::header-element -->



                    </div>
                    <!-- End::header-content-right -->


                </div>
        </header>

        @include('pelaporan.components.sidebar2')
        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    @include('pelaporan.components.footer-js')
</body>

</html>
