@extends('templates.default')

@section('page.title', 'Produit ajouté au panier - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <h1 class="text-center h3">{{ $item->product->title }} a été ajouté au panier</h1>

    <div class="row">
        <div class="col-12">
            <p>Produit : {{ $item->product->title }}</p>
            <p>Prix unitaire : {{ $item->product->priceFormatted }}</p>
            <p>Quantité : {{ $item->quantity }}</p>
            <p>Prix total : {{ $item->priceFormatted }}</p>
        </div>
    </div>
@endsection
