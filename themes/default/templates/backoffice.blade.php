<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,600;0,800;1,300;1,600;1,800&display=swap">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/backoffice.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@3.16.3/dist/tagify.min.css">

    <title>@yield('page.title', "Back Office") - TitanShop</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <div id="backoffice-container" class="d-flex">
        @include('default.components.backoffice.sidenav')
        <div id="backoffice-content" class="w-100 p-3 container-fluid transition">
            <button id="sidenav-open-btn" type="button" class="btn btn-primary">
                <i class="fas fa-bars"></i>
            </button>
            @yield('page.content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@3.16.3/dist/jQuery.tagify.min.js"></script>

    <script>
        $('#sidenav-open-btn').on('click', function () {
            $('#backoffice-content').toggleClass('open');
            $('#backoffice-sidenav').toggleClass('open');
        });
    </script>

    @yield('page.scripts')
</body>
</html>
