<div id="sidenav" class="bg-white p-2 shadow-sm h-100 w-100">
    <h1 class="h4 text-center mb-0">Titan Shop</h1>
    <a class="text-muted d-flex justify-content-center" href="{{ route('index') }}">
        Voir le site
        <img src="{{ asset('images/icons/eye-bw.svg') }}" class="svg ml-1" alt="eye icon">
    </a>

    @include('themes.default.components.admin.sidenav-links')
</div>
