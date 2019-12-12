<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- SEO -->
    <meta name="author" content="Martin Halaj" href="{{ url('')}}">
	<meta name="robots" content="index,follow">
	<meta name="keywords" content=""> <!-- Your keywords -->
	<meta name="description" content=""> <!-- Your description -->
	<!-- FACEBOOK -->
	<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
	<meta property="og:image:height" content="503">
	<meta property="og:image:width" content="961">
	<meta property="og:description" content=""> <!-- Your facebook description -->
	<meta property="og:title" content="{{ config('app.name', 'Laravel') }}">
    <meta property="og:url" content="{{url('/')}}">
	<meta property="og:image" content="{{ asset('')}}"> <!-- Your facebook image -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700i&display=swap" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('cookieConsent::index')
    <header class="site-header">

         @include('navigation')

    </header>
    <main id="app">

            @yield('content')

        <flash-message text="{{ session('flash') }}"></flash-message>

    </main>
</body>
</html>
