<div id="backoffice-sidenav" class="p-3 border-right d-flex flex-column justify-content-between">
    <div class="sidenav-top">
        <p id="sidenav-title" class="font-weight-bold">TitanShop</p>
        <a href="{{route('homepage')}}" class="text-muted">Voir la boutique</a>
        <div class="sidenav-links-container d-flex flex-column">

            <a href="{{route('admin.homepage')}}" class="sidenav-link transition @if(Route::current()->getName() == 'admin.homepage') active @endif">
                <i class="fas fa-home"></i>
                Accueil
            </a>
            <a href="{{route('admin.orders')}}" class="sidenav-link transition @if(Route::current()->getName() == 'admin.orders') active @endif">
                <i class="fas fa-cubes"></i>
                Commandes
            </a>
            <a href="{{route('admin.catalog')}}" class="sidenav-link transition @if(Route::current()->getName() =='admin.catalog') active @endif">
                <i class="fas fa-book"></i>
                Catalogue
            </a>
            <p class="sidenav-link transition disabled noselect">
                <i class="fas fa-wrench"></i>
                Paramètres
            </p>

        </div>
    </div>

    <div class="sidenav-bottom text-center">
        <a class="text-muted" href="{{route('admin.logout')}}">← Déconnexion</a>
    </div>

</div>
