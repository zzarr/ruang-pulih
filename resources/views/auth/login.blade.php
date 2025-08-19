<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masuk</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="bootstrap template, template dashboard bootstrap, admin template, html admin panel template, bootstrap admin template, html and css templates, bootstrap, bootstrap html template, html admin dashboard template, bootstrap dashboard, admin panel html template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.header-css')


</head>

<body class="login-img">

    <!-- Loader -->
    <div id="loader">
        <img src="../assets/images/media/loader.svg" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- PAGE -->
        <div class="page login-page">
            <div>
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="../assets/images/brand-logos/desktop-white.png" class="header-brand-img"
                            alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="card  wrap-login100 p-0">
                        <div class="card-body">
                            <form class="login100-form validate-form" method="POST"
                                action="{{ route('login.process') }}">
                                @csrf
                                <span class="login100-form-title">
                                    Masuk
                                </span>
                                <div class="wrap-input100 validate-input"
                                    data-bs-validate="Valid email is required: ex@abc.xyz">
                                    <input type="email" class="form-control input100" name="email" id="input"
                                        placeholder="Email" value="{{ old('email') }}" required>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="ri-mail-fill" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                    <input type="password" class="form-control input100" name="password" id="input2"
                                        placeholder="Password" required>

                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="ri-lock-fill" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot
                                            Password?</a></p>
                                </div>
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary">
                                        Login
                                    </button>
                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">belum punya akun?<a href="{{ route('register') }}"
                                            class="text-primary ms-1">buat akun</a></p>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->




    </div>




</body>

</html>
