@extends('templates.cart')

@section('cart.title', 'Mon panier - Paiement par chèque')

@section('cart.breadcrumb')
    / <a href="{{ route('cart.payment') }}">Paiement</a>
    / <a href="{{ route('cart.payment.cheque') }}">Paiement par chèque</a>
@endsection

@section('cart.content')
<div id="payment-cheque" class="mb-3 mb-lg-0 p-3 bg-white shadow-sm">
    <p>Vous trouverez ici les instructions pour payer par chèque.</p>
</div>
@endsection

@section('cart.summary.next-button')
<a class="btn btn-primary w-100 mt-3" href="{{ route('cart.create-order') }}" role="button">Valider ma commande</a>
@endsection

@section('cart.summary.other')
<div class="bg-white shadow-sm row p-3 mt-3 mx-0">
    @foreach ($cart->items as $item)
        <div class="col-1 px-0">
            <img id="big-image" class="img-fluid w-100"
                src="{{ asset($item->product->images->first()->path ?? null) }}"
                alt="{{ $item->product->images->first()->alt ?? $item->product->title }}"
                title="{{ $item->product->images->first()->alt ?? $item->product->title }}">
        </div>
        <div class="col-11">
            <a href="{{ route('product.show', ['product' => $item->product]) }}">{{ $item->product->title }}</a>
        </div>
    @endforeach
</div>

<div class="bg-white shadow-sm row p-3 mt-3 mx-0">
    <div id="shipping-address" class="mini-address">
        <p class="address-title">Adresse de livraison</p>
        <p class="address-text">{!! $cart->shippingAddress !!}</p>
    </div>

    <div id="billing-address" class="mt-3 mini-address">
        <p class="address-title">Adresse de facturation</p>
        <p class="address-text">{!! $cart->billingAddress !!}</p>
    </div>
</div>
@endsection
