@extends('templates.cart')

@section('cart.content')
<form id="delivery-form" class="mb-3 mb-lg-0 p-0" action="{{ route('cart.delivery.add-addresses') }}" method="POST">
    <p>Veuillez selectionner un moyen de paiement :</p>
    <p>TODO</p>
</form>
@endsection

@section('cart.summary.next-button')
<label class="btn btn-primary w-100 mt-3 mb-0" for="submit-form" tabindex="0">
    Payer</label>
@endsection

@section('cart.summary.other')
<div class="bg-light shadow-sm row p-3 mt-3 mx-0">
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

<div class="bg-light shadow-sm row p-3 mt-3 mx-0">
    <div id="shipping-address" class="mini-address">
        <p class="font-weight-bold address-title">Adresse de livraison</p>
        <p class="address-text">{!! $cart->shippingAddress !!}</p>
    </div>

    <div id="billing-address" class="mt-3" class="mini-address">
        <p class="font-weight-bold address-title">Adresse de facturation</p>
        <p class="address-text">{!! $cart->billingAddress !!}</p>
    </div>
</div>
@endsection
