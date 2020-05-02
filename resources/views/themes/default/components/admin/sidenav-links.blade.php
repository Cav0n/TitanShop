<div class="sidenav mt-3 d-flex flex-column">
    <div class="row mx-0 mx-lg-2">
        <div class="d-none d-lg-flex flex-column col-2 p-0">
            <img src="{{ asset('images/icons/homepage-bw.svg') }}" alt="homepage icon" class="svg w-100 {{ request()->route()->named('admin.index') ? 'active' : null }}" >
        </div>
        <div class="px-0 px-lg-2 col-12 col-lg-10 d-flex flex-column">
            <a href="{{ route('admin.index') }}" class="h5 mb-0 {{ request()->route()->named('admin.index') ? 'active' : null }}">
                Accueil</a>
            <a href="{{ route('admin.index') }}" class="{{ request()->route()->named('admin.index') ? 'active' : null }}">
                Page d'accueil</a>
        </div>
    </div>

    <div class="row mx-0 mx-lg-2 mt-2">
        <div class="d-none d-lg-flex flex-column col-2 p-0">
            <img src="{{ asset('images/icons/orders-bw.svg') }}" alt="orders icon" class="svg w-100 {{ request()->route()->named('admin.orders') ? 'active' : null }}" >
        </div>
        <div class="px-0 px-lg-2 col-12 col-lg-10 d-flex flex-column">
            <a href="{{ route('admin.orders') }}" class="h5 mb-0 {{ request()->route()->named('admin.orders') ? 'active' : null }}">
                Commandes</a>
            <a href="{{ route('admin.orders') }}" class="{{ request()->route()->named('admin.orders') ? 'active' : null }}">
                Toutes les commandes</a>
        </div>
    </div>

    <div class="row mx-0 mx-lg-2 mt-2">
        <div class="d-none d-lg-flex flex-column col-2 p-0">
            <img src="{{ asset('images/icons/products-bw.svg') }}" alt="products icon" class="svg w-100 {{ request()->route()->named('admin.products') ? 'active' : null }}">
        </div>
        <div class="px-0 px-lg-2 col-12 col-lg-10 d-flex flex-column">
            <a href="{{ route('admin.products') }}" class="h5 mb-0 {{ request()->route()->named('admin.products') ? 'active' : null }}">
                Produits</a>
            <a href="{{ route('admin.products') }}" class="{{ request()->route()->named('admin.products') ? 'active' : null }}">
                Tous les produits</a>
            <a href="{{ route('admin.categories') }}" class="{{ request()->route()->named('admin.categories') ? 'active' : null }}">
                Toutes les catégories</a>
        </div>
    </div>

    <div class="row mx-0 mx-lg-2 mt-2">
        <div class="d-none d-lg-flex flex-column col-2 p-0">
            <img src="{{ asset('images/icons/customers-bw.svg') }}" alt="customers icon" class="svg w-100 {{ request()->route()->named('admin.users') ? 'active' : null }}">
        </div>
        <div class="px-0 px-lg-2 col-12 col-lg-10 d-flex flex-column">
            <a href="{{ route('admin.users') }}" class="h5 mb-0 {{ request()->route()->named('admin.users') ? 'active' : null }}">
                Clients</a>
            <a href="{{ route('admin.users') }}" class="{{ request()->route()->named('admin.users') ? 'active' : null }}">
                Tous les clients</a>
        </div>
    </div>

    <div class="row mx-0 mx-lg-2 mt-2">
        <div class="d-none d-lg-flex flex-column col-2 p-0">
            <img src="{{ asset('images/icons/settings-bw.svg') }}" alt="settings icon" class="svg w-100 {{ request()->route()->named('admin.settings') ? 'active' : null }}">
        </div>
        <div class="px-0 px-lg-2 col-12 col-lg-10 d-flex flex-column">
            <a href="{{ route('admin.settings') }}" class="h5 mb-0 {{ request()->route()->named('admin.settings') ? 'active' : null }}">
                Paramètres</a>
            <a href="{{ route('admin.settings') }}" class="{{ request()->route()->named('admin.settings') ? 'active' : null }}">
                Tous les paramètres</a>
        </div>
    </div>

    <div class="row mx-0 mx-lg-2 mt-2 pt-2 border-top">
        <div class="d-none d-lg-flex flex-column col-2 p-0">
            <img src="{{ asset('images/icons/logout-bw.svg') }}" alt="settings icon" class="svg w-100">
        </div>
        <div class="px-0 px-lg-2 col-12 col-lg-10 d-flex flex-column justify-content-center">
            <a href="{{ route('admin.logout') }}">
                Déconnexion</a>
        </div>
    </div>
</div>
