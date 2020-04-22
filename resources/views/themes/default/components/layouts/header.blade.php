<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('index') }}">{{ \App\Setting::valueOrNull('SHOP_NAME') }}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#headerNavbar" aria-controls="headerNavbar"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="headerNavbar">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">Accueil</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">
                        Espace client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">
                        Mon panier</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
