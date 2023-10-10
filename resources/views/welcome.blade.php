<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>POST VENTA</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('Site/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Site/assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('Site/assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('Site/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('Site/assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Site/assets/css/main.css') }}" />

</head>

<body>


    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ route('Pagina') }}">
                                <img style="width: 100px" src="{{ asset('vendor/adminlte/dist/img/POSTVENTASINFONDO.png') }}" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="{{ route('Pagina') }}" class="active" aria-label="Toggle navigation">Home</a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">Manual de Uso</a>
          
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" aria-label="Toggle navigation">Contactenos</a>
                                    </li>
                                </ul>
                            </div> 
                            <!-- navbar collapse -->
                            @if (Route::has('login'))
                            <div class="button home-btn">
                                @auth 
                                <a href="{{ url('/home') }}" class="btn">Home</a>
                                @else
                                <a href="{{ route('login') }}" class="btn">Login</a>
                                @endauth
                            </div>
                            @endif
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

    

    <!-- Start Hero Area -->
    
    <section class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 col-12">
                    <div class="hero-content">
                        <h4>Software Punto de Venta</h4>
                        <h1>POST VENTA</h1>
                        <p>Descubre el secreto detrás del éxito de miles de negocios <br>POST VENTA. Nuestro innovador sistema de punto de venta no solo agiliza las transacciones, sino que transforma la forma en que gestionas tu comercio.
                        </p>
                        <div class="button">
                            <a href="{{ route('register') }}" class="btn ">Try for free</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-12">
                    <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                        <img class="main-image" style="width: 500px" src="{{ asset('vendor/adminlte/dist/img/Dashboard.png') }}" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->
            <!-- Start Pricing Table Area -->
            <section id="pricing" class="pricing-table section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h3 class="wow zoomIn" data-wow-delay=".2s">Precios</h3>
                                <h2 class="wow fadeInUp" data-wow-delay=".4s">Planes de Subscripcion</h2>
                                <p class="wow fadeInUp" data-wow-delay=".6s">Estos son nuestros diferentes planes para poder manejar tu propio sistema de venta en tu empresa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                            <!-- Single Table -->
                            <div class="single-table">
                                <!-- Table Head -->
                                <div class="table-head">
                                    <h4 class="title">Basic</h4>
                                  
                                    <div class="price">
                                        <h2 class="amount"><span class="currency">$</span>19<span class="duration">/month</span>
                                        </h2>
                                    </div>
                                </div>
                                <!-- End Table Head -->
                                <!-- Start Table Content -->
                                <div class="table-content">
                                    <!-- Table List -->
                                    <ul class="table-list">
                                        <li>2 Cajas y +4 Usuarios</li>
                                        <li>Inventario de Ventas</li>
                                        <li>Ventas</li>
                                        <li>Reportes</li>
                                        <li class="disable">Inventario de Produccion</li>
                                        <li class="disable">Facturacion Electronica</li>
                                    </ul>
                                    <!-- End Table List -->
                                </div>
                                <!-- End Table Content -->
                                <div class="button">
                                    <a href="{{ route('register') }}" class="btn">Aquirir Membresia <i
                                            class="lni lni-arrow-right"></i></a>
                                </div>
                                <p class="no-card">No credit card required</p>
                            </div>
                            <!-- End Single Table-->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                            <!-- Single Table -->
                            <div class="single-table middle">
                                <span class="popular">Most Popular</span>
                                <!-- Table Head -->
                                <div class="table-head">
                                    <h4 class="title">Exclusive</h4>
                                  
                                    <div class="price">
                                        <h2 class="amount"><span class="currency">$</span>49<span class="duration">/month</span>
                                        </h2>
                                    </div>
                                </div>
                                <!-- End Table Head -->
                                <!-- Start Table Content -->
                                <div class="table-content">
                                    <!-- Table List -->
                                    <ul class="table-list">
                                        <li>8 Cajas y Usuario Ilimitado</li>
                                        <li>Inventario de Ventas</li>
                                        <li>Ventas</li>
                                        <li>Reportes</li>
                                        <li >Inventario de Produccion</li>
                                        <li class="disable">Facturacion Electronica</li>
                                    </ul>
                                    <!-- End Table List -->
                                </div>
                                <!-- End Table Content -->
                                <div class="button">
                                    <a href="{{ route('register') }}" class="btn btn-alt">Aquirir Membresia <i
                                            class="lni lni-arrow-right"></i></a>
                                </div>
                                <p class="no-card">No credit card required</p>
                            </div>
                            <!-- End Single Table-->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".8s">
                            <!-- Single Table -->
                            <div class="single-table">
                                <!-- Table Head -->
                                <div class="table-head">
                                    <h4 class="title">Premium</h4>
                                    
                                    <div class="price">
                                        <h2 class="amount"><span class="currency">$</span>99<span class="duration">/month</span>
                                        </h2>
                                    </div>
                                </div>
                                <!-- End Table Head -->
                                <!-- Start Table Content -->
                                <div class="table-content">
                                    <!-- Table List -->
                                    <ul class="table-list">
                                        <li>Cajas Ilimitadas y Usuario Ilimitado</li>
                                        <li>Inventario de Ventas</li>
                                        <li>Ventas</li>
                                        <li>Reportes</li>
                                        <li >Inventario de Produccion</li>
                                        <li >Facturacion Electronica</li>
                                    </ul>
                                    <!-- End Table List -->
                                </div>
                                <!-- End Table Content -->
                                <div class="button">
                                    <a href="{{ route('register') }}" class="btn">Aquirir Membresia <i
                                            class="lni lni-arrow-right"></i></a>
                                </div>
                                <p class="no-card">No credit card required</p>
                            </div>
                            <!-- End Single Table-->
                        </div>
                    </div>
                </div>
        </section>
            <!--/ End Pricing Table Area -->

    <!-- Start Features Area -->
    
    <section class="freatures section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <div class="image wow fadeInLeft" data-wow-delay=".3s">
                        <img src="{{ asset('vendor/adminlte/dist/img/Panel.png') }}" alt="#">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="content">
                        <h3 class="heading wow fadeInUp" data-wow-delay=".5s"><span>Beneficios</span>Características Destacadas</h3>
                        <!-- Start Single Feature -->
                        <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                            <div class="f-icon">
                                <i class="lni lni-dashboard"></i>
                            </div>
                            <h4>Ventas Rápidas e Intuitivas</h4>
                            <p>La interfaz amigable y los procesos optimizados te permiten realizar ventas de forma rápida y sencilla.</p>
                        </div>
                        <!-- End Single Feature -->
                        <!-- Start Single Feature -->
                        <div class="single-feature wow fadeInUp" data-wow-delay=".7s">
                            <div class="f-icon">
                                <i class="lni lni-pencil-alt"></i>
                            </div>
                            <h4>Seguridad y Confiabilidad</h4>
                            <p>Con POST VENTA, tus datos están seguros y tus operaciones son confiables.</p>
                        </div>
                        <!-- End Single Feature -->
                        <!-- Start Single Feature -->
                        <div class="single-feature wow fadeInUp" data-wow-delay="0.8s">
                            <div class="f-icon">
                                <i class="lni lni-vector"></i>
                            </div>
                            <h4>Adaptado a tu Negocio</h4>
                            <p>POST VENTA se adapta a tus necesidades y crece contigo.</p>
                        </div>
                        <!-- End Single Feature -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features Area -->

    <!-- Start Services Area -->
    <div class="services section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Que Ofrecemos?</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Nuestros servicios</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Estos son los servicios que te brinda POST VENTA para tu empresa</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="lni lni-grid-alt"></i>
                        </div>
                        <h4 class="text-title">Gestion de Cajas</h4>
                        <p>Con este módulo, el usuario puede administrar las transacciones relacionadas con el flujo de dinero en su negocio. Puede abrir y cerrar cajas, así como mantener un registro detallado de los movimientos financieros.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="lni lni-keyword-research"></i>
                        </div>
                        <h4 class="text-title">Inventarios</h4>
                        <p>A través de este módulo, el usuario tiene la capacidad de controlar minuciosamente todos los productos o bienes que posee su empresa. Puede añadir, eliminar y hacer un seguimiento detallado de cada elemento en su inventario.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="lni lni-vector"></i>
                        </div>
                        <h4 class="text-title">Ventas</h4>
                        <p>Con este módulo, el usuario puede llevar a cabo todo el proceso de ventas de su negocio. Puede crear pedidos, facturar y dar seguimiento a cada venta realizada, lo que le permite mantener un control efectivo sobre sus operaciones comerciales.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="lni lni-book"></i>
                        </div>
                        <h4 class="text-title">Facturacion Electronica</h4>
                        <p>Este módulo permite al usuario generar facturas electrónicas de manera eficiente, lo cual es crucial para cumplir con las obligaciones fiscales de su empresa. Puede crear y enviar facturas electrónicas de forma rápida y segura.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="lni lni-cloud-network"></i>
                        </div>
                        <h4 class="text-title">Controles de Empleados y Reportes</h4>
                        <p>A través de este módulo, el usuario tiene acceso a herramientas que le permiten generar informes detallados sobre diversos aspectos de su negocio. Puede crear informes financieros y de ventas, entre otros, para obtener una visión completa de su rendimiento empresarial.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="lni lni-display-alt"></i>
                        </div>
                        <h4 class="text-title">Administracion </h4>
                        <p>Con este módulo, el usuario puede gestionar y administrar todos los aspectos fundamentales del sistema. Desde configurar usuarios y permisos hasta realizar ajustes en la configuración del sistema, tiene el control total sobre la operación y funcionalidad de su plataforma.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Area -->





    <!-- Start Team Area -->
    <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Depelopers Teams</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">  Conozca a nuestros Equipo</h2>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".3s">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="team-image">
                            <img src="{{ asset('Teams/FOTODIEGO.jpg') }}" alt="#">
                        </div>
                        <div class="content">
                            <h4>Diego Alexnader
                                <span>Ing de Software</span>
                            </h4>
                            <ul class="social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".5s">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="team-image">
                            <img src="https://via.placeholder.com/400x400" alt="#">
                        </div>
                        <div class="content">
                            <h4>Adrian Rosales Velasco
                                <span>Desarrollador</span>
                            </h4>
                            <ul class="social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".7s">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="team-image">
                            <img src="https://via.placeholder.com/400x400" alt="#">
                        </div>
                        <div class="content">
                            <h4>Daniel Montaño Vargas
                                <span>Desarrollador</span>
                            </h4>
                            <ul class="social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".9s">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="team-image">
                            <img src="{{ asset('Teams/FOTOEDBERTO.jpg') }}" alt="#">
                        </div>
                        <div class="content">
                            <h4>Edberto Ybanera
                                <span>Desarrollador</span>
                            </h4>
                            <ul class="social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
            </div>
        </div>
    </section>
    <!--/ End Team Area -->







    <!-- Start Footer Area -->
    <footer class="footer section">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-about">
                                <div class="logo">
                                    <a href="{{ route('Pagina') }}">
                                        <img src="{{ asset('vendor/adminlte/dist/img/POSTVENTASINFONDO.png') }}" alt="LOGO">
                                    </a>
                                </div>
                                <p>POST VENTA, es una software punto de venta(Post) para las pequeñas, mediana y grandes empresas.</p>
                                <h4 class="social-title">Siguenos:</h4>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-pinterest"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-youtube"></i></a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Funciones</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Ventas</a></li>
                                    <li><a href="javascript:void(0)">Inventario</a></li>
                                    <li><a href="javascript:void(0)">Facturacion Electronica</a></li>
                                    <li><a href="javascript:void(0)">Reportes</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Support</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Precios</a></li>
                                    <li><a href="javascript:void(0)">Contacto</a></li>
                                    <li><a href="javascript:void(0)">Manual de Uso</a></li>
                                    
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer newsletter">
                                <h3>Subscribe</h3>
                                <p>Contactanos para Pasar La materia</p>
                                <form action="#" method="get" target="_blank" class="newsletter-form">
                                    <input name="EMAIL" placeholder="Email address" required="required" type="email">
                                    <div class="button">
                                        <button class="sub-btn"><i class="lni lni-envelope"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
        <!-- Start Copyright Area -->
        <div class="copyright-area">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <p class="copyright-text">© 2023 POST VENTA - Todos los derechos Reservados</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <p class="copyright-owner">Desarrollado por <a 
                                     target="_blank">Estudiantes SI2</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('Site/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Site/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('Site/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('Site/assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('Site/assets/js/count-up.min.js') }}"></script>
    <script src="{{ asset('Site/assets/js/main.js') }}"></script>
    <script>

        //========= testimonial 
        tns({
            container: '.testimonial-slider',
            items: 3,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 0,
            nav: true,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 2,
                },
                1170: {
                    items: 3,
                }
            }
        });

        //====== counter up 
        var cu = new counterUp({
            start: 0,
            duration: 2000,
            intvalues: true,
            interval: 100,
            append: " ",
        });
        cu.start();

        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });

    </script>
</body>

</html>