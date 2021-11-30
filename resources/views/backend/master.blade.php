<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title>Setup</title>

    <link rel="preload" href="{{ asset('/backend/fonts/Gilroy-Light.woff') }}" as="font" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/backend/fonts/Gilroy-Medium.woff') }}" as="font" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/backend/fonts/Gilroy-Regular.woff') }}" as="font" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/backend/fonts/Gilroy-SemiBold.woff') }}" as="font" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/backend/fonts/NoeDisplay-Medium.woff') }}" as="font" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/backend/css/style.min.css') }}" type="text/css"/>
</head>
<body>
<div class="main-container">
    @include('backend._header')
    <main>
        @yield('content')
    </main>
    @include('backend._footer')
    <div class="loader">
        <img src="{{ asset('/backend/img/loader.svg') }}" alt="loader">
    </div>
</div>
<script src="{{ asset('/backend/js/script.min.js') }}"></script>
</body>
</html>
