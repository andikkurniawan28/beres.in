<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{-- <meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> --}}
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>{{ $global["app_name"] }}</title>
<link rel="stylesheet" type="text/css" href="/Laravel-Starter/public/azures/code/styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/Laravel-Starter/public/azures/code/styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/Laravel-Starter/public/azures/code/fonts/css/fontawesome-all.min.css">
{{-- <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js"> --}}
<link rel="icon" type="image/png" href="{{ "/Laravel-Starter/public/app_icon/".$global["app_icon"] }}"/>
</head>

<body class="theme-light" data-highlight="blue2">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div class="header header-fixed header-auto-show header-logo-app">
        <a href="{{ route("application-customer.index") }}" class="header-title">{{ $global["app_name"] }}</a>
    </div>
    <div id="footer-bar" class="footer-bar-5">
        <a href="{{ route("application-partner.index") }}" @if(Route::currentRouteName() === "application-partner.index") class="active-nav" @endif><i data-feather="home" data-feather-line="1" data-feather-size="21" data-feather-color="black" data-feather-bg="white"></i><span>Home</span></a>
        <a href="{{ route("application-partner.pesanan") }}" @if(Route::currentRouteName() === "application-partner.pesanan") class="active-nav" @endif><i data-feather="folder" data-feather-line="1" data-feather-size="21" data-feather-color="black" data-feather-bg="white"></i><span>Pesanan</span></a>
        <a href="{{ route("logout") }}"><i data-feather="log-out" data-feather-line="1" data-feather-size="21" data-feather-color="black" data-feather-bg="white"></i><span>Logout</span></a>
    </div>

    <div class="page-content">

        <div class="page-title page-title-large">
            <h2 data-username="{{ ucfirst(Auth::user()->role->name) }} {{ Auth::user()->name }}" class="greeting-text"></h2>
            <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="/Laravel-Starter/public/admin/img/undraw_profile.svg"></a>
        </div>
        <div class="card header-card shape-rounded bg-primary" data-card-height="210">
        </div>

        @yield("content")

    </div>
    <!-- end of page content-->


</div>

<script type="text/javascript" src="/Laravel-Starter/public/azures/code/scripts/jquery.js"></script>
<script type="text/javascript" src="/Laravel-Starter/public/azures/code/scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="/Laravel-Starter/public/azures/code/scripts/custom.js"></script>
</body>
