@extends('templates.cart')

@section('cart.content')
    @foreach ($cart->items as $item)
    <div class="cart-item bg-light shadow-sm p-3 @if(! $loop->last) mb-3 @endif">
        <div class="row">
            <div class="col-lg-10">
                <a href="{{ route('product.show', ['product' => $item->product]) }}" class="h5">{{ $item->product->title }}</a>
                <p>Prix unitaire : {{ $item->product->priceFormatted }}</p>
                <p>Quantité : {{ $item->quantity }}</p>
            </div>
            <div class="col-lg-2 d-flex flex-column justify-content-center border-left">
                <p class="text-center">{{ $item->priceFormatted }}</p>
            </div>
        </div>

    </div>
    @endforeach
@endsection

@section('cart.summary.next-button')
    <a class="btn btn-primary w-100 mt-3" href="{{ route('cart.delivery') }}" role="button">Valider le panier</a>
@endsection
