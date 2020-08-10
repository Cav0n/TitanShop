<div id="backoffice-sidenav" class="p-3 border-right d-flex flex-column justify-content-between">
    <div id="sidenav-top">
        <p id="sidenav-title" class="font-weight-bold">TitanShop</p>
        <a href="{{route('homepage')}}" class="text-muted">Voir la boutique</a>
        <div class="sidenav-links-container d-flex flex-column">

            <a href="{{route('admin.homepage')}}" class="sidenav-link transition @if(Route::current()->getName() === 'admin.homepage') active @endif">
                <i class="fas fa-home"></i>
                Accueil
            </a>

            <a href="{{route('admin.orders')}}" class="sidenav-link transition @if(Route::current()->getName() === 'admin.orders' || Route::current()->getName() === 'admin.order.show') active @endif">
                <i class="fas fa-cubes"></i>
                Commandes
            </a>
            <div class="sublinks-container
                @if (
                    Route::current()->getName() === 'admin.orders' ||
                    Route::current()->getName() === 'admin.order.show'
                )
                    show
                @endif">

                <a class="sublink transition noselect {{ !isset($status) ? 'active' : '' }}" href="{{ route('admin.orders') }}">
                    Tout types <span class="badge badge-primary">{{ count(\App\Models\Order::all()) }}</span>
                </a>

                @foreach (\App\Models\OrderStatus::all() as $orderStatus)
                <a class="sublink transition noselect {{ (isset($status) && $status->id === $orderStatus->id) ? 'active' : '' }} {{ count(\App\Models\Order::where('order_status_id', $orderStatus->id)->get()) <= 0 ? 'disabled' : '' }}"
                    @if (count(\App\Models\Order::where('order_status_id', $orderStatus->id)->get()) > 0) href="{{ route('admin.orders', ['status' => $orderStatus] ) }}" @endif>
                    {{ $orderStatus->i18nValue('title') }} <span class="badge badge-primary">{{ count(\App\Models\Order::where('order_status_id', $orderStatus->id)->get()) }}</span>
                </a>
                @endforeach
            </div>

            <a href="{{route('admin.catalog')}}" class="sidenav-link transition
                @if (
                    Route::current()->getName() === 'admin.catalog'             ||
                    Route::current()->getName() === ('admin.product.create')    ||
                    Route::current()->getName() === ('admin.product.edit')      ||
                    Route::current()->getName() === ('admin.category.create')   ||
                    Route::current()->getName() === ('admin.category.edit')
                )
                    active
                @endif">
                <i class="fas fa-book"></i>
                Catalogue
            </a>

            <a href="{{ route('admin.customers') }}" class="sidenav-link transition
                @if (
                    Route::current()->getName() === 'admin.customers'       ||
                    Route::current()->getName() === 'admin.customer.show'
                )
                    active
                @endif">
                <i class="fas fa-user"></i>
                Clients
            </a>

            <p class="sidenav-link transition disabled noselect">
                <i class="fas fa-wrench"></i>
                Paramètres
            </p>

        </div>
    </div>

    <div id="sidenav-bottom"  class="text-center">
        <a class="text-muted" href="{{route('admin.logout')}}">← Déconnexion</a>
    </div>

</div>
