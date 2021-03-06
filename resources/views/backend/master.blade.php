<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
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
