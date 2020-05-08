<header class="sticky-top bg-white shadow-sm">
    <nav class="navbar navbar-expand-sm navbar-light">
        <a class="navbar-brand" href="{{ route('index') }}">{{ \App\Setting::valueOrNull('SHOP_NAME') }}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#headerNavbar" aria-controls="headerNavbar"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="headerNavbar">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ \App\Utils::active('index') }}">
                    <a class="nav-link" href="{{ route('index') }}">Accueil</a>
                </li>

                @foreach (\App\CategoryBase::
                    where('isVisible', 1)
                    ->where('isDeleted', 0)
                    ->where('parent_id', null)
                    ->get() as $category)
                <li class="nav-item {{ \App\Utils::active('category.show', ['category' => $category->id]) }}">
                    <a class="nav-link" href="{{ route('category.show', ['category' => $category]) }}">{{ $category->title }}</a>
                </li>
                @endforeach
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ \App\Utils::active('customer-area')}}">
                    <a class="nav-link" href="{{ route('customer-area.index') }}">
                        Espace client</a>
                </li>
                <li class="nav-item {{ \App\Utils::active('cart')}}">
                    <a class="nav-link" href="{{ route('cart') }}">
                        Mon panier</a>
                </li>
            </ul>

        </div>
    </nav>
</header>
