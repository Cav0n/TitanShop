<header class="row">
    <div class="col-12 d-flex justify-content-between py-3">
        <div class="header-left">
            <a href="{{route('homepage')}}" class="text-dark">
                <h1>TitanShop</h1>
            </a>
        </div>
        <div class="header-right d-none d-lg-flex">
            <div class="d-flex flex-column justify-content-center">
                <input type="text" placeholder="Search" class="form-control search">
            </div>
            <div class="header-link d-flex flex-column justify-content-center px-3">
                <a href="#">Mon compte</a>
            </div>
            <div class="header-link d-flex flex-column justify-content-center px-3">
                <a href="{{route('cart')}}">Mon panier</a>
            </div>
        </div>
    </div>
</header>
