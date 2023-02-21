@include('helpers.flash-message')
<!--
=========================================================
Material Dashboard PRO - v2.2.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard-pro
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        ..:: Sistema ATLAS - DIRINFRA ::..
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/material-dashboard.css?v=2.2.2') }}" rel="stylesheet" />
    @stack('extra_css')
    @stack('extra_style')
    {{--    <!-- CSS Just for demo purpose, don't include it in your project -->--}}
    {{--    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />--}}
</head>

<body class="off-canvas-sidebar">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
{{--        <div class="navbar-wrapper">--}}
{{--            <a class="navbar-brand" href="javascript:;">Sistema ATLAS</a>--}}
{{--        </div>--}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="sr-only">Toggle navigation</span>--}}
{{--            <span class="navbar-toggler-icon icon-bar"></span>--}}
{{--            <span class="navbar-toggler-icon icon-bar"></span>--}}
{{--            <span class="navbar-toggler-icon icon-bar"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse justify-content-end">--}}
{{--            <ul class="navbar-nav">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="../dashboard.html" class="nav-link">--}}
{{--                        <i class="material-icons">dashboard</i>--}}
{{--                        Dashboard--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item ">--}}
{{--                    <a href="../pages/register.html" class="nav-link">--}}
{{--                        <i class="material-icons">person_add</i>--}}
{{--                        Register--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item  active ">--}}
{{--                    <a href="../pages/login.html" class="nav-link">--}}
{{--                        <i class="material-icons">fingerprint</i>--}}
{{--                        Login--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item ">--}}
{{--                    <a href="../pages/lock.html" class="nav-link">--}}
{{--                        <i class="material-icons">lock_open</i>--}}
{{--                        Lock--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>
</nav>
<!-- End Navbar -->
<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset("assets/img/atlas5.jpg") }}'); background-size: cover; background-position: top center;">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('login') }}" novalidate="novalidate">
                        @csrf
                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">Sistema ATLAS - Login</h4>
{{--                                <div class="social-line">--}}
{{--                                    <a href="#pablo" class="btn btn-just-icon btn-link btn-white">--}}
{{--                                        <i class="fa fa-facebook-square"></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="#pablo" class="btn btn-just-icon btn-link btn-white">--}}
{{--                                        <i class="fa fa-twitter"></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="#pablo" class="btn btn-just-icon btn-link btn-white">--}}
{{--                                        <i class="fa fa-google-plus"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                            <div class="card-body ">
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">email</i>
                                            </span>
                                        </div>
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </span>
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="Senha">
                                    </div>
                                </span>
                            </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit" class="btn btn-primary btn-link btn-lg">Acessar</button>
                            </div>
                        </div>
                        {!! Honeypot::generate('atlas_mel', 'atlas_time') !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/material-dashboard.js?v=2.2.2') }}" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
@stack('extra_js')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.card').removeClass('card-hidden');
        }, 700);
    });
</script>
<script>
    fabNot = {
        showNotification: function(type, message) {
            $.notify({
                icon: "add_alert",
                message: message
            }, {
                type: type,
                timer: 3000,
                placement: {
                    from: "top",
                    align: "center"
                }
            });
        }
    }
</script>

@stack('extra_script')
</body>

</html>
