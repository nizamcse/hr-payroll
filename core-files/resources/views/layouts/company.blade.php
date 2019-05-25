<!doctype html>
<html lang="en">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="base-url" content="{{ url('/') }}">
<title>Company Title{{ config('app.name', 'Laravel') }}</title>

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
@yield('styles')
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
                        <li><a href="{{ route('logout') }}" class="icon-menu"><i class="icon-login"></i> Logout</a></li>
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
                        <li class="active"><a href="{{ url('/') }}"><i class="icon-speedometer"></i><span>HR Dashboard</span></a></li>
                        <li><a href="{{ route('basic-settings') }}"><i class="fa fa-cogs"></i><span>Basic Settings</span></a></li>
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
                                <li><a href="{{ route('attendance-report') }}">Attendance Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Employees" class="has-arrow"><i class="icon-users"></i><span>Pay Role</span></a>
                            <ul>
                                <li><a href="{{ route('pay-scales') }}">Pay Scale</a></li>
                                <li><a href="{{ route('show-calculate-salary') }}">Calculate Attendance</a></li>
                                <li><a href="{{ route('create-salary') }}">Create Salary</a></li>
                                <li><a href="{{ route('employee-salaries') }}">Salaries</a></li>
                                <li><a href="{{ route('salary-reports') }}">Salary Sheet</a></li>
                                <li><a href="{{ route('payment-methods') }}">Payment Method</a></li>
                                <li><a href="{{ route('salary-reports') }}">Salary Payments</a></li>
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


<div class="modal animated zoomIn" id="delete-content-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <h3>Do you want to delete this content.</h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <a href="#" id="delete-modal-btn" class="btn btn-danger">YES</a>
            </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click','.btn-delete',function(){
            var url = $(this).data('url');
            $("#delete-modal-btn").attr('href',url);
        });
    });

</script>
</body>
</html>

