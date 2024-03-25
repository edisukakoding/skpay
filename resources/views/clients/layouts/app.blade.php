<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Ratchet template page</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="{{ asset('library/ratchet-2.0.2/dist/css/ratchet.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/sk-customs.css') }}">

    {{-- midtrans --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-amUvbuqWgI0vmQGs"></script>
</head>

<body>

    <!-- Make sure all your bars are the first things in your <body> -->
    <header class="bar bar-nav" style="background-color: #428bca;">
        <h1 class="title" style="color: white"><strong><span class="icon icon-home"></span>
                {{ auth()->user()->customer->block }}</strong></h1>
    </header>
    @yield('content')
    <form action="{{ route('logout') }}" method="POST" id="form-logout">
        @csrf
    </form>
    <!-- Include the compiled Ratchet JS -->
    <script src="{{ asset('library/ratchet-2.0.2/docs/dist/js/ratchet.min.js') }}"></script>
</body>

</html>
