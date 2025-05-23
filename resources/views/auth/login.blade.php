<!DOCTYPE html>

<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST_VENTA - LOGIN</title>
    <meta name="description"
        content="A modern CRM Dashboard Template with reusable and flexible components for your SaaS web applications by hencework. Based on Bootstrap." />

  
    <link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Wrapper -->
    <div class="hk-wrapper hk-pg-auth" data-footer="simple">
        <!-- Main Content -->
        <div class="hk-pg-wrapper pt-0 pb-xl-0 pb-5">
            <div class="hk-pg-body pt-0 pb-xl-0">
                <!-- Container -->
                <div class="container-xxl">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-10 position-relative mx-auto">
                            <div class="auth-content py-8">
                                <form class="w-100" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
                                            <div class="text-center mb-7">
                                                <a class="navbar-brand me-0" href="index.html">
                                                    <img class="brand-img d-inline-block" src="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}"
                                                        alt="POSTVENTA" style="width: 150px">
                                                </a>
                                            </div>
                                            <div class="card card-lg card-border">
                                                <div class="card-body">
                                                    <h4 class="mb-4 text-center">Inicia Sesion </h4>
                                                    <div class="row gx-3">
                                                        <div class="form-group col-lg-12">
                                                            <div class="form-label-group">
                                                                <label>Correo Electronico</label>
                                                            </div>
                                                            <input
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                id="email" type="email" name="email"
                                                                value="{{ old('email') }}" required
                                                                autocomplete="email" autofocus>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-12">
                                                            <div class="form-label-group">
                                                                <label>Password</label>
                                                                <a href="#" class="fs-7 fw-medium">Forgot Password
                                                                    ?</a>
                                                            </div>
                                                            <div class="input-group password-check">
                                                                <span class="input-affix-wrapper">
                                                                    <input id="password" type="password"
                                                                        class="form-control @error('password') is-invalid @enderror"
                                                                        name="password" required
                                                                        autocomplete="current-password">

                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    <a href="#" class="input-suffix text-muted">
                                                                        <span class="feather-icon"><i class="form-icon"
                                                                                data-feather="eye"></i></span>
                                                                        <span class="feather-icon d-none"><i
                                                                                class="form-icon"
                                                                                data-feather="eye-off"></i></span>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="form-check form-check-sm mb-3">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label class="form-check-label text-muted fs-7"
                                                                for="logged_in">Recordar</label>
                                                        </div>
                                                    </div>
                                                    <button  type="submit"
                                                        class="btn btn-primary btn-uppercase btn-block">Login</button>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                                                        </div>
                                                        
                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->
                </div>
                <!-- /Container -->
            </div>
            <!-- /Page Body -->

            <!-- Page Footer -->
            <div class="hk-footer border-0">
                <footer class="container-xxl footer">
                    <div class="row">
                        <div class="col-xl-8 text-center">
                            <p class="footer-text pb-0"><span class="copy-text">POST_VENTA © 2023 TODOS LOS DERECHOS RESERVADOS PARA SI2</span>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- / Page Footer -->

        </div>
        <!-- /Main Content -->
    </div>
    <!-- /Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('Template/vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('Template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- FeatherIcons JS -->
    <script src="{{ asset('Template/dist/js/feather.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('Template/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('Template/vendors/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
</body>

</html>
