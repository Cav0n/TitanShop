<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,900;1,400;1,500;1,600;1,900&display=swap" rel="stylesheet">
    @yield('page.css_import')

    <title>@yield('page.title', \App\Setting::valueOrNull('SHOP_NAME'))</title>
</head>
<body class="d-flex flex-column">
    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('page.js_import')

    @include('themes.default.components.layouts.header')

    @yield('page.content')

    @include('themes.default.components.layouts.footer')

    @yield('scripts')
</body>
</html>
