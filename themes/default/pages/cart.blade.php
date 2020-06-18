@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Mon panier
    </h2>

    <div id="cart-container" class="row mx-0 mb-3">
        <div class="col-12 text-center py-5">
            <p>Votre panier est vide.</p>
        </div>
    </div>
@endsection