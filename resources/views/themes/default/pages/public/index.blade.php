@extends('templates.default')

@section('page.title', App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <h1>{{ App\Setting::valueOrNull('SHOP_NAME') }}</h1>
    <p>{{ App\Setting::valueOrNull('SHOP_DESCRIPTION') }}</p>

    @if(0 === count($products))
    <p class="h3 text-center">Aucun produit n'est en vente pour le moment</p>
    @endif

    <div class="row">
        @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3">
            @include('themes.default.components.layouts.product', [
                'product' => $product,
            ])
        </div>
        @endforeach
    </div>
@endsection
