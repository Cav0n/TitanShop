<header class="row">
    <div class="col-12 d-flex justify-content-between py-3">
        <div class="header-left">
            <a href="{{route('homepage')}}" class="text-dark">
                <h1>TitanShop</h1>
            </a>
        </div>
        <div class="header-right d-none d-lg-flex justify-content-end w-100 pl-3">
            <div class="d-flex flex-column justify-content-center w-100">
                <div class="search-container d-flex justify-content-end">
                    <input type="text" placeholder="Search" class="form-control search header-search transition">
                </div>
            </div>
            <div class="header-link d-flex flex-column justify-content-center px-3">
                <a class="text-dark" href="#">Mon compte</a>
            </div>
            <div class="header-link d-flex flex-column justify-content-center px-3">
                <a class="text-dark" href="{{route('cart')}}">Mon panier</a>
            </div>
        </div>
    </div>
</header>
