@extends('templates.default')

@section('page.title', App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    @hook(['code' => 'public.homepage.top'])

    <h1>{{ App\Setting::valueOrNull('SHOP_NAME') }}</h1>
    <p>{{ App\Setting::valueOrNull('SHOP_DESCRIPTION') }}</p>

    @if(0 === count($products))
    <div class="text-center">
        <p class="h3">Aucun produit n'est en vente pour le moment</p>
        @isAdmin
        <a class="btn btn-primary mt-2" href="{{route('admin.product.create')}}" role="button">Ajouter un produit dès maintenant</a>
        @endisAdmin
    </div>
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

    @hook(['code' => 'public.homepage.bottom'])
@endsection
