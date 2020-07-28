<div id="backoffice-sidenav" class="p-3 border-right">
    <p id="sidenav-title" class="font-weight-bold">TitanShop</p>
    <a href="{{route('homepage')}}" class="text-muted">Voir la boutique</a>
    <div class="sidenav-links-container d-flex flex-column">

        <a href="{{route('admin.homepage')}}" class="sidenav-link transition @if(Route::current()->getName() == 'admin.homepage') active @endif">
            Accueil
        </a>
        <a href="{{route('admin.orders')}}" class="sidenav-link transition @if(Route::current()->getName() == 'admin.orders') active @endif">
            Commandes
        </a>
        <a href="{{route('admin.catalog')}}" class="sidenav-link transition @if(Route::current()->getName() =='admin.catalog') active @endif">
            Catalogue
        </a>
        <p class="sidenav-link transition disabled noselect">
            Paramètres
        </p>

    </div>
</div>
