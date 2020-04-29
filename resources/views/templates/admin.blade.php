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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,900;1,400;1,500;1,600;1,900&display=swap" rel="stylesheet">
    @yield('page.css_import')

    <title>@yield('page.title', 'Backoffice') - Titan Shop</title>
</head>
<body>
    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('page.js_import')

    @if (\App\Admin::check())
    <header class="d-flex d-lg-none">
        <nav class="navbar navbar-expand-sm navbar-light bg-light w-100">
            <a class="navbar-brand" href="#">Titan Shop</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                @include('themes.default.components.admin.sidenav-links')
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div id="sidenav-container" class="col-0 col-lg-2 p-2 sticky-top d-none d-lg-flex">
                @include('themes.default.components.admin.sidenav')
            </div>

            <div class="col-12 col-lg-10 px-3 py-2">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="d-flex flex-column">
                        <h1 class="h3 mb-0">
                            @yield('page.title', 'BackOffice - Titan Shop')
                        </h1>

                        <div class="mb-2">
                            @yield('page.breadcrumb')
                        </div>
                    </div>
                    <div class="buttons-container">
                        @yield('page.buttons')
                    </div>
                </div>


                @yield('page.content')
            </div>
        </div>
    </div>
    @else
    <div class="container-fluid">
        @yield('page.content')
    </div>
    @endif

    {{-- Convert "img" to svg --}}
    <script>
        $(document).ready(function(){
            /* Replace all SVG images with inline SVG */
            jQuery('img.svg').each(function(){
                var $img = jQuery(this);
                var imgID = $img.attr('id');
                var imgClass = $img.attr('class');
                var imgURL = $img.attr('src');
                jQuery.get(imgURL, function(data) {
                    // Get the SVG tag, ignore the rest
                    var $svg = jQuery(data).find('svg');

                    // Add replaced image's ID to the new SVG
                    if(typeof imgID !== 'undefined') {
                        $svg = $svg.attr('id', imgID);
                    }
                    // Add replaced image's classes to the new SVG
                    if(typeof imgClass !== 'undefined') {
                        $svg = $svg.attr('class', imgClass+' replaced-svg');
                    }

                    // Remove any invalid XML tags as per http://validator.w3.org
                    $svg = $svg.removeAttr('xmlns:a');

                    // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
                    if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                        $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                    }

                    // Replace image with new SVG
                    $img.replaceWith($svg);

                }, 'xml');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
