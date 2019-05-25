<!doctype html>
<html lang="en">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="base-url" content="{{ url('/') }}">
<title>{{ config('app.name', 'Winskit Hr Solution') }}</title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/font-awesome/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/chartist/css/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/toastr/toastr.min.css') }}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/color_skins.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
</head>
<body class="theme-orange">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{ asset('public/admin/assets/images/winskit-logo-272.png')}}" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">

    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>

            <div class="navbar-brand">
                <a href="{{ url('/') }}"><img src="{{ asset('public/admin/assets/images/winskit-logo-272.png')}}" alt="Lucid Logo" class="img-responsive logo"></a>
            </div>

            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-equalizer"></i></a>
                            <ul class="dropdown-menu user-menu menu-icon animated bounceIn">
                                <li class="menu-heading">ACCOUNT SETTINGS</li>
                                <li><a href="javascript:void(0);"><i class="icon-note"></i> <span>Basic</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-equalizer"></i> <span>Preferences</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-lock"></i> <span>Privacy</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-bell"></i> <span>Notifications</span></a></li>
                                <li class="menu-heading">BILLING</li>
                                <li><a href="javascript:void(0);"><i class="icon-credit-card"></i> <span>Payments</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-printer"></i> <span>Invoices</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-refresh"></i> <span>Renewals</span></a></li>
                            </ul>
                        </li>
                        <li><a href="page-login.html" class="icon-menu"><i class="icon-login"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account d-flex align-items-start justify-content-around p-2 m-0">
                <img src="{{ asset('public/admin/assets/images/user.png') }}" class="rounded-circle user-photo" alt="User Profile Picture">
                <div>
                    <span>Welcome,<strong>{{ Auth::user()->name }}</strong></span>
                    <p class="m-0"><span>{{ Auth::user()->email }}</span></p>
                </div>
                <hr>
            </div>

            <div class="sidebar-nav-container">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li class="active"><a href="index.html"><i class="icon-speedometer"></i><span>HR Dashboard</span></a></li>
                        <li><a href="{{ route('vacations') }}"><i class="icon-vector"></i>Vacations</a></li>
                        <li><a href="{{ route('branches') }}"><i class="icon-home"></i>Branches</a></li>
                        <li><a href="{{ route('sections') }}"><i class="icon-list"></i>Section</a></li>
                        <li><a href="{{ route('lines') }}"><i class="icon-layers"></i>Line</a></li>
                        <li>
                            <a href="#Employees" class="has-arrow"><i class="icon-users"></i><span>Employees</span></a>
                            <ul>
                                <li><a href="{{ route('designations') }}">Designations</a></li>
                                <li><a href="{{ route('deduction-types') }}">Deduction Types</a></li>
                                <li><a href="{{ route('bonuses') }}">Bonuses</a></li>
                                <li><a href="{{ route('leave-types') }}">Leave Types</a></li>
                                <li><a href="{{ route('employees') }}">All Employees</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Machine" class="has-arrow"><i class="fa fa-cog"></i><span>Machine</span></a>
                            <ul>
                                <li><a href="{{ route('devices') }}">Devices</a></li>
                                <li><a href="{{ route('update-logs') }}">Update Log</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div id="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

</div>

<!-- Javascript -->
<script src="{{ asset('public/admin/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('public/admin/assets/bundles/vendorscripts.bundle.js') }}"></script>

<script src="{{ asset('public/admin/assets/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('public/admin/assets/bundles/chartist.bundle.js') }}"></script>
<script src="{{ asset('public/admin/assets/bundles/knob.bundle.js') }}"></script> <!-- Jquery Knob-->

<script src="{{ asset('public/admin/assets/bundles/mainscripts.bundle.js') }}"></script>
@yield('script')
</body>
</html>

