<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- OpenGraph --}}
    @yield('page.og')

    {{-- Icons --}}
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,900;1,400;1,500;1,600;1,900&display=swap" rel="stylesheet"/>
    @yield('page.css_import')

    {{-- Title and description --}}
    <title>@yield('page.title', \App\Setting::valueOrNull('SHOP_NAME'))</title>
    <meta name="description" content="@yield('page.description', \App\Setting::valueOrNull('SHOP_DESCRIPTION') ?? 'Un site créé avec TitanShop CMS.')"/>
</head>
<body class="d-flex flex-column">
    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('page.js_import')

    @include('themes.default.components.layouts.header')

    <div id="main" class="container-fluid d-flex flex-column justify-content-center my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                @hook(['code' => 'public.template.top'])

                @yield('page.content')

                @hook(['code' => 'public.template.bottom'])

            </div>
        </div>
    </div>

    @include('themes.default.components.layouts.footer')

    @yield('scripts')
</body>
</html>
