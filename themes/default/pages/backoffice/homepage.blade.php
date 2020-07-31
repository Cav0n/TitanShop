@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12">
            <h1>Accueil</h1>
        </div>
        <div class="col-lg-2 text-center">
            <h2 class="superhuge">{{count(App\Models\Order::all())}}</h2>
            <p>Commandes</p>
        </div>
        <div class="col-lg-2 text-center">
            <h2 class="superhuge">{{count(App\Models\Category::all())}}</h2>
            <p>Catégories</p>
        </div>
        <div class="col-lg-2 text-center">
            <h2 class="superhuge">{{count(App\Models\Product::all())}}</h2>
            <p>Produits</p>
        </div>
    </div>
@endsection
