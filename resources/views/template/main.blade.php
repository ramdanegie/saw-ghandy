<!DOCTYPE html>
<html lang="en" ng-app="angularApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System SAW</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="icon" type="image/png" href="{{ asset('login/images/icons/favicon.ico') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.css')}}">
    <!-- jsGrid -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jsgrid/jsgrid-theme.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
</head>
<style>
    body {

        font-weight: 400;
        font-family: 'Poppins', sans-serif;
    }
    button, select, html, textarea, input {
        font-family: 'Poppins', sans-serif;
    }

</style>
@yield('css')
<body class="dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div id="showLoading" style="z-index:1051;position: fixed;left: 0;
    right: 0;
    bottom: 40%;
    text-align: center;" class="animated loading">
    <img height="100" src="{!! asset('load2.gif') !!}"/>
</div>
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('adminlte/dist/img/primeng-logo.png') }}" alt="SAW" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="index3.html" class="nav-link">Home</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="#" class="nav-link">Contact</a>--}}
{{--            </li>--}}
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-44">
        <!-- Brand Logo -->
        <a href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" => 'dashboard' ]) !!}" class="brand-link">
            <img src="{{ asset('adminlte/dist/img/primeng-logo.png') }}" alt="SAW Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SPK-SAW</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar ">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('adminlte/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"> {!! $_SESSION['namaLengkap'] !!}</a>
                </div>
            </div>


                @include('template.side')
        </div>
        <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
         @yield('content-body')

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <span>Copyright © 2021. All Rights Reserved.</span>

    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('node_modules/vendors/toastr/toastr.min.js')}}"></script>
<!-- angular -->
<script src="{{ asset('node_modules/angular/angular.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/angular-material/angular-material.css') }}">
<script src="{{ asset('node_modules/angular/angular-route.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/angular-animate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/angular-aria.min.js') }}"></script>
<script src="{{ asset('node_modules/angular/angular-material.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminlte/plugins/jsgrid/demos/db.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jsgrid/jsgrid.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>

    /*
   * angular initialize
   */
    var baseUrl = {!! json_encode(url('/')) !!}

    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}","Info");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}","Info");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}","Info");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}","Info");
            break;
    }
        @endif

    var angular = angular.module('angularApp', ['ngMaterial'], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('@{{');
            $interpolateProvider.endSymbol('}}');
        }).factory('httpService', function ($http, $q) {
            return {
                get: function (url) {
                    $("#showLoading").show()
                    var deffer = $q.defer();
                    $http.get(baseUrl + '/' + url, {
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    }).then(function successCallback(response) {
                        deffer.resolve(response);
                        $("#showLoading").hide()
                    }, function errorCallback(response) {
                        deffer.reject(response);
                        $("#showLoading").hide()
                    });
                    return deffer.promise;
                },
                postLog: function (jenislog, referensi, noreff, keterangan) {
                    $("#showLoading").show()
                    var deffer = $q.defer();
                    $http.get(baseUrl + "/logging/save-log-all?jenislog=" + jenislog + "&referensi=" +
                        referensi + '&noreff=' + noreff + '&keterangan=' + keterangan, {
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    }).then(function successCallback(response) {
                        deffer.resolve(response);
                        $("#showLoading").hide()
                    }, function errorCallback(response) {
                        deffer.reject(response);
                        $("#showLoading").hide()
                    });
                    return deffer.promise;
                },

                post: function (url, data) {
                    $("#showLoading").show()
                    var deffer = $q.defer();
                    var req = {
                        method: 'POST',
                        url: baseUrl + '/' + url,
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        data: data
                    }
                    $http(req).then(function successCallback(response, a, b) {
                        $("#showLoading").hide()
                        if (response.data.message != undefined) {
                            toastr.success(response.data.message,"Info");
                        } else {
                            if (response.data.messages != undefined) {
                                toastr.success(response.data.message,"Info");

                            }
                        }

                        deffer.resolve(response);
                    }, function errorCallback(response) {
                        $("#showLoading").hide()
                        if (response.data.message != undefined) {
                            toastr.error(response.data.message,"Info");
                        } else {
                            if (response.data.messages != undefined) {
                                toastr.error(response.data.message,"Info");

                            }
                        }

                        deffer.reject(response);

                    });
                    return deffer.promise;
                },

                put: function (url, data) {
                    $("#showLoading").show()
                    var deffer = $q.defer();
                    var req = {
                        method: 'PUT',
                        url: baseUrl + '/' + url,
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        data: data
                    }
                    $http(req).then(function successCallback(response, a, b) {
                        deffer.resolve(response);
                        $("#showLoading").hide()
                    }, function errorCallback(response) {
                        deffer.reject(response);
                        $("#showLoading").hide()
                    });
                    return deffer.promise;
                },
                delete: function (url) {
                    var deffer = $q.defer();
                    var req = {
                        method: 'DELETE',
                        url: baseUrl + '/' + url,
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    }
                    $http(req).then(function successCallback(response, a, b) {
                        deffer.resolve(response);
                        $("#showLoading").hide()
                    }, function errorCallback(response) {
                        deffer.reject(response);
                        $("#showLoading").hide()
                    });
                    return deffer.promise;
                },
            }
        });
    $('.select2').select2()
    $("#showLoading").hide()
    $(document).on({
        ajaxStart: function () {
            $("#showLoading").show()
        },
        ajaxStop: function () {
            $("#showLoading").hide()
        }

    });
</script>
@yield('javascript')

</body>
</html>
