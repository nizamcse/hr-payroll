<!doctype html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Winskit Hr Solution') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Winskit Hr Solution">
    <meta name="author" content="WinskitHr, design by: Winskit.com">

    <link rel="icon" href="{{ asset('public/favicon/favicon.ico') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/font-awesome/css/font-awesome.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/color_skins.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
</head>

<body class="theme-orange">
<!-- WRAPPER -->
<div id="wrapper">
    <div class="row align-items-center justify-content-center authentication-page-wrapper m-0">
        <div class="col-md-5 d-sm-none d-md-block description-container">
            <div class="app-description">
                <h4 class="title">Winskit Hr Solution</h4>
                <p>
                    Winskit provides a wide-range of software application development services that are essential for businesses.
                    Our standalone and custom software solutions not only save you time and money,
                    but also give you the competitive edge to achieve your goals without compromising on quality.
                </p>
            </div>
        </div>
        <div class="col-md-7 form-container align-items-center align-content-center d-flex bg-white">
            @yield('content')
        </div>
    </div>
</div>
<!-- END WRAPPER -->
</body>
</html>