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
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('assets/img/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/img/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/img/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/img/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('assets/img/favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('assets/img/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('assets/img/favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('assets/img/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-128.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('assets/img/favicon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('assets/img/favicon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('assets/img/favicon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('assets/img/favicon/mstile-310x310.png') }}" />
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

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="black" data-image="{{ asset('assets/img/sidebar-atlas.jpg') }}">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo"><a href="#" class="simple-text logo-mini">
                <img width="100%" src="{{ asset('assets/img/fab/qoeng_lowres.png') }}" alt="" />
            </a>
            <a href="#" class="simple-text logo-normal">
                Sistema ATLAS
            </a></div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="{{ asset('assets/img/faces/avatar2.png') }}" />
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" href="#collapseExample" class="username">
                        <span>
                        {{ auth()->user()->ranking->short }} {{ auth()->user()->name }}
                        <b class="caret"></b>
                        </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('changepass.form') }}">
                                    <span class="sidebar-mini"> AS </span>
                                    <span class="sidebar-normal"> Alterar Senha </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="sidebar-mini"> S </span>
                                    <span class="sidebar-normal"> Sair </span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }} ">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">dashboard</i>
                        <p> Início </p>
                    </a>
                </li>
                @canany(['mo_access','user_access','activity_type_access','system_log_access'])
                    <li class="nav-item {{ request()->routeIs('admin*') ? 'active' : '' }} ">
                        <a class="nav-link" data-toggle="collapse" href="#admCollapse" {!! request()->routeIs('admin*') ? 'aria-expanded="true"' : '' !!}>
                            <i class="material-icons">settings</i>
                            <p> Administração <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin*') ? 'show' : '' }}" id="admCollapse">
                            <ul class="nav">
                                @can('log_access')
                                    <li class="nav-item  {{ request()->routeIs('admin.logs*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('admin.logs.index') }}">
                                            <span class="sidebar-mini"> LS </span>
                                            <span class="sidebar-normal"> Logs do Sistema </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('mo_access')
                                    <li class="nav-item  {{ request()->routeIs('admin.om*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('admin.om.index') }}">
                                            <span class="sidebar-mini"> OM </span>
                                            <span class="sidebar-normal"> Organizações Militares </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('user_access')
                                    <li class="nav-item  {{ request()->routeIs('admin.usuarios*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('admin.usuarios.index') }}">
                                            <span class="sidebar-mini"> U </span>
                                            <span class="sidebar-normal"> Usuários </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('activity_type_access')
                                    <li class="nav-item  {{ request()->routeIs('admin.tipos_atividade*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('admin.tipos_atividade.index') }}">
                                            <span class="sidebar-mini"> TA </span>
                                            <span class="sidebar-normal"> Tipos de Atividade </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany
                <li class="nav-item {{ request()->routeIs('activities*') ? 'active' : '' }} ">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">checklist</i>
                        <p> Atividades </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('reports*') ? 'active' : '' }} ">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">assignment</i>
                        <p> Relatórios </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i>
                        <p> Sair </p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-background"></div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <a class="navbar-brand" href="javascript:;">@yield('page_title')</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-right">
                    <ul>
                        <li>
                            <a href="#" target="_blank">
                                Sistema ATLAS | {{ now('America/Sao_Paulo')->format('d/m/Y') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<!-- Plugin for the momentJs  -->
<script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.js') }}"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('assets/js/plugins/jquery.validate.min.js') }}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('assets/js/plugins/jquery-jvectormap.js') }}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('assets/js/plugins/nouislider.min.js') }}"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('assets/js/plugins/arrive.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/material-dashboard.js?v=2.2.2') }}" type="text/javascript"></script>
@stack('extra_js')
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
