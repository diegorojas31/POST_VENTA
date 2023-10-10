@extends('adminlte::page')

@section('title', 'POST-VENTA Home')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon"
    style="border-radius: 50%;">



@section('content_header')
    <h1>Panel administrativo  (Proximamente)</h1>
@stop

@section('content')

    <div class="tab-pane fade show active" id="tab_block_1">
        <div class="row">
            <div class="col-xxl-9 col-lg-8 col-md-7 mb-md-4 mb-3">
                <div class="card card-border mb-0 h-100">
                    <div class="card-header card-header-action">
                        <h6>Productos Vendidos</h6>
               
                    </div>
                    
                    <div class="card-body">
                        <div class="text-center">
                            <div class="d-inline-block">
                                <span class="badge-status">
                                    <span class="badge bg-primary badge-indicator badge-indicator-nobdr"></span>
                                    <span class="badge-label">Direct</span>
                                </span>
                            </div>
                            <div class="d-inline-block ms-3">
                                <span class="badge-status">
                                    <span class="badge bg-primary-light-2 badge-indicator badge-indicator-nobdr"></span>
                                    <span class="badge-label">Organic search</span>
                                </span>
                            </div>
                            <div class="d-inline-block ms-3">
                                <span class="badge-status">
                                    <span class="badge bg-primary-light-4 badge-indicator badge-indicator-nobdr"></span>
                                    <span class="badge-label">Referral</span>
                                </span>
                            </div>
                        </div>
                        <div id="column_chart_2"></div>
                        <div class="separator-full mt-5"></div>
                        <div class="flex-grow-1 ms-lg-3">
                            <div class="row">
                                <div class="col-xxl-3 col-sm-6 mb-xxl-0 mb-3">
                                    <span class="d-block fw-medium fs-7">Users</span>
                                    <div class="d-flex align-items-center">
                                        <span class="d-block fs-4 fw-medium text-dark mb-0">8.8k</span>
                                        <span class="badge badge-sm badge-soft-success ms-1">
                                            <i class="bi bi-arrow-up"></i> 7.5%
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 mb-xxl-0 mb-3">
                                    <span class="d-block fw-medium fs-7">Sessions</span>
                                    <div class="d-flex align-items-center">
                                        <span class="d-block fs-4 fw-medium text-dark mb-0">18.2k</span>
                                        <span class="badge badge-sm badge-soft-success ms-1">
                                            <i class="bi bi-arrow-up"></i> 7.2%
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 mb-xxl-0 mb-3">
                                    <span class="d-block fw-medium fs-7">Bounce rate</span>
                                    <div class="d-flex align-items-center">
                                        <span class="d-block fs-4 fw-medium text-dark mb-0">46.2%</span>
                                        <span class="badge badge-sm badge-soft-danger ms-1">
                                            <i class="bi bi-arrow-down"></i> 0.2%
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6">
                                    <span class="d-block fw-medium fs-7">Session duration</span>
                                    <div class="d-flex align-items-center">
                                        <span class="d-block fs-4 fw-medium text-dark mb-0">4m 24s</span>
                                        <span class="badge badge-sm badge-soft-success ms-1">
                                            <i class="bi bi-arrow-up"></i> 10.8%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-4 col-md-5 mb-md-4 mb-3">
                <div class="card card-border mb-0  h-100">
                    <div class="card-header card-header-action">
                        <h6>Ingresos</h6>
                        <div class="card-action-wrap">
                            <a class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover dropdown-toggle no-caret"
                                href="#" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i
                                            data-feather="more-vertical"></i></span></span></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div id="radial_chart_2"></div>
                        <div class="d-inline-block mt-4">
                            <div class="mb-4">
                                <span class="d-block badge-status lh-1">
                                    <span
                                        class="badge bg-primary badge-indicator badge-indicator-nobdr d-inline-block"></span>
                                    <span class="badge-label d-inline-block">Ganancias</span>
                                </span>
                                <span class="d-block text-dark fs-5 fw-medium mb-0 mt-1">$1000</span>
                            </div>
                            <div>
                                <span class="badge-status lh-1">
                                    <span class="badge bg-primary-light-2 badge-indicator badge-indicator-nobdr"></span>
                                    <span class="badge-label">Ganancias Netas</span>
                                </span>
                                <span class="d-block text-dark fs-5 fw-medium mb-0 mt-1">$200</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Daterangepicker CSS -->
    <link href="{{ asset('Template/vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />

    <!-- Data Table CSS -->
    <link href="{{ asset('Template/vendors/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('Template/vendors/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">


@stop

@section('js')
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

    <!-- Data Table JS -->
    <script src="{{ asset('Template/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Daterangepicker JS -->
    <script src="{{ asset('Template/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('Template/dist/js/daterangepicker-data.js') }}"></script>



    <!-- Apex JS -->
    <script src="{{ asset('Template/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/dashboard-data.js') }}"></script>
    <script>
        console.log('Hi!');
    </script>


@stop
