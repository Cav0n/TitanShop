@extends('templates.default')

@section('page.title', 'Produit ajouté au panier - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <h1 class="text-center h3">{{ $item->product->title }} a été ajouté au panier</h1>

    <div class="row bg-light shadow-sm p-3 mx-0">
        <div class="col-2 col-md-1 mx-0">
            <img id="big-image" class="img-fluid w-100"
                src="{{ asset($item->product->images->first()->path ?? null) }}"
                alt="{{ $item->product->images->first()->alt ?? $item->product->title }}"
                title="{{ $item->product->images->first()->alt ?? $item->product->title }}">
        </div>
        <div class="col-10 col-md-6 d-flex flex-column justify-content-center">
            <p>{{ $item->product->title }}</p>
            <p class="d-md-none">
                Prix unitaire : {{ $item->product->priceFormatted }}<br>
                Quantité dans le panier : {{ $item->quantity }}<br>
                Prix total : <b>{{ $item->priceFormatted }}</b>
            </p>
        </div>
        <div class="col-2 flex-column justify-content-center d-none d-md-flex">
            <p>{{ $item->product->priceFormatted }}</p>
        </div>
        <div class="col-1 flex-column justify-content-center d-none d-md-flex">
            <p>{{ $item->quantity }}</p>
        </div>
        <div class="col-2 flex-column justify-content-center d-none d-md-flex">
            <p><b>{{ $item->priceFormatted }}</b></p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="offset-lg-6 col-12 col-md-6 col-lg-3">
            <a class="btn btn-secondary w-100" href="{{ route('product.show', ['product' => $item->product]) }}" role="button">Revenir au produit</a>
        </div>
        <div class="col-12 col-md-6 col-lg-3 pr-lg-0 mt-3 mt-md-0">
            <a class="btn btn-primary w-100" href="{{ route('cart') }}" role="button">Aller au panier</a>
        </div>
    </div>
@endsection
