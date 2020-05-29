<div id="sidenav" class="p-2 h-100 w-100">
    <div class="row">
        <div class="col-10 offset-2">
            <h1 class="h4 text-left mb-0 pl-lg-2">Titan Shop</h1>
            <a class="text-muted d-flex justify-content-start pl-lg-2" href="{{ route('index') }}">
                Voir le site
                <img src="{{ asset('images/icons/eye-bw.svg') }}" class="svg ml-1" alt="eye icon">
            </a>
        </div>
    </div>

    @include('themes.default.components.admin.sidenav-links')
</div>
