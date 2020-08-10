<header class="row border-bottom">
    <div class="col-12 d-flex justify-content-between py-3">
        <div class="header-left">
            <a href="{{route('homepage')}}" class="text-dark">
                <h1>TitanShop</h1>
            </a>
        </div>
        <div class="header-right justify-content-end w-100 pl-3">
            {{-- MOBILE --}}
            <div class="d-flex d-lg-none justify-content-end">
                <button id="burger" class="open-main-nav">
                    <span class="burger"></span>
                    <span class="burger-text">Menu</span>
                </button>

                <nav class="main-nav" id="main-nav">
                    <ul>
                        <li>
                            <a href="{{route('homepage')}}">Accueil</a>
                        </li>
                        <li>
                            <a href="{{route('customer-area.homepage')}}">Mon compte</a>
                        </li>
                        <li class="d-flex">
                            <a href="{{route('cart')}}">Mon panier</a>
                            <span class="cart-total-quantity badge badge-pill badge-dark my-auto ml-2 h-fit-content">
                                @if(session()->get('cart') !== null)
                                {{ session()->get('cart')->totalQuantity > 99 ? '99+' : session()->get('cart')->totalQuantity }}
                                @else
                                0
                                @endif
                            </span>
                        </li>
                        @foreach(\App\Models\Category::where('isDeleted', 0)->where('isVisible', 1)->take(5)->get() as $category)
                        <li style="max-width: 12rem;">
                            <a href="{{route('category.show', ['category' => $category->code])}}">{{$category->i18nValue('title')}}</a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            {{-- DESKTOP --}}
            <div class="d-none d-lg-flex">
                <div class="d-flex flex-column justify-content-center w-100">
                    <div class="search-container d-flex justify-content-end">
                        <input type="text" placeholder="Rechercher" class="form-control search header-search transition">
                    </div>
                </div>
                <div class="header-link d-flex flex-column justify-content-center px-3">
                    <i class="fas fa-user"></i>
                    <a class="text-dark" href="{{route('customer-area.homepage')}}">Mon compte</a>
                </div>
                <div class="header-link d-flex flex-column justify-content-center px-3">
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-total-quantity badge badge-pill badge-light ml-1">
                            @if(session()->get('cart') !== null)
                            {{ session()->get('cart')->totalQuantity > 99 ? '99+' : session()->get('cart')->totalQuantity }}
                            @else
                            0
                            @endif
                        </span>
                    </div>
                    <a class="text-dark" href="{{route('cart')}}">Mon panier</a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    let burger = document.getElementById('burger'),
        nav    = document.getElementById('main-nav');

    burger.addEventListener('click', function(e){
        this.classList.toggle('is-open');
        nav.classList.toggle('is-open');
    });
</script>
