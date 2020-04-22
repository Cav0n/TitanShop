@extends('templates.default')

@section('page.title', App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <div id="homepage" class="container-fluid d-flex flex-column justify-content-center my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                @if(0 === count($products))
                    <h1 class="text-center">Aucun produit n'est en vente pour le moment</h1>
                @endif

                <div class="row">
                    @foreach ($products as $product)

                    <div class="col-6 col-sm-4 col-lg-3">
                        @include('themes.default.components.layouts.product', [
                            'product' => $product,
                        ])
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
