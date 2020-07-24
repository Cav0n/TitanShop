<!DOCTYPE html>

<!--
 /$$$$$$$$ /$$   /$$
|__  $$__/|__/  | $$
   | $$    /$$ /$$$$$$    /$$$$$$  /$$$$$$$
   | $$   | $$|_  $$_/   |____  $$| $$__  $$
   | $$   | $$  | $$      /$$$$$$$| $$  \ $$
   | $$   | $$  | $$ /$$ /$$__  $$| $$  | $$
   | $$   | $$  |  $$$$/|  $$$$$$$| $$  | $$
   |__/   |__/   \___/   \_______/|__/  |__/



  /$$$$$$  /$$
 /$$__  $$| $$
| $$  \__/| $$$$$$$   /$$$$$$   /$$$$$$
|  $$$$$$ | $$__  $$ /$$__  $$ /$$__  $$
 \____  $$| $$  \ $$| $$  \ $$| $$  \ $$
 /$$  \ $$| $$  | $$| $$  | $$| $$  | $$
|  $$$$$$/| $$  | $$|  $$$$$$/| $$$$$$$/
 \______/ |__/  |__/ \______/ | $$____/
                              | $$
                              | $$
                              |__/
-->

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,600;0,800;1,300;1,600;1,800&display=swap">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicons/manifest.jso')}}n">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    {{-- -------- --}}

    {{-- Open Graph Meta --}}
    <meta property="og:title" content="@yield('page.title', 'TitanShop')" />
    <meta property="og:type" content="@yield('og.type', 'website')" />
    <meta property="og:url" content="@yield('og.url', request()->url())" />
    <meta property="og:image" content="@yield('og.image', asset('favicons/apple-icon.png'))" />
    <meta property="og:description" content="@yield('og.description', 'Un site créé avec TitanShop, le CMS de SpaceShip.')" />
    {{-- --------------- --}}

    <title>@yield('page.title', "Accueil") - TitanShop</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <div id="main-container" class="container-fluid">
        @include('default.components.header')

        {{-- Content --}}
        <div class="row">
            <div class="col-12">
                @yield('page.content')
            </div>
        </div>
    </div>


    @include('default.components.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield('page.scripts')
</body>
</html>
