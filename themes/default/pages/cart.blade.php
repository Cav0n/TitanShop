@php
    $cart = session()->get('cart');
@endphp

@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Mon panier
    </h2>

    @include('default.components.cart-steps')

    <div id="cart-container" class="row mx-0 mb-3">
        @if (0 !== count($cart->items))
        <div id="items-container" class="col-lg-8 p-3">
            <h3>Produits</h3>

            <table class="table table-bordered mb-0 bg-white">
                <tbody>
                    @foreach ($cart->items as $item)
                    <tr class="cart-item">
                        <td>{{$item->product->i18nValue('title')}}</td>
                        <td class="text-center">x {{$item->quantity}}</td>
                        <td class="text-right">{{$item->priceFormatted}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group mt-3 mb-0">
                <label for="customer-message">Message pour votre commande</label>
                <textarea class="form-control" name="customer-message" id="customer-message" aria-describedby="helpCustomerMessage" rows=4></textarea>
                <small id="helpCustomerMessage" class="form-text text-muted">Vous pouvez indiquez des précisions pour votre commande ici.</small>
            </div>
        </div>
        <div id='summary' class="col-lg-4 p-3">
            <h3>Résumé</h3>

            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-left">{{$cart->totalQuantity}} produits :</td>
                        <td class="text-right">{{$cart->itemsPriceFormatted}}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Frais de port :</td>
                        <td class="text-right">{{$cart->shippingPriceFormatted}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><b>Total :</b></td>
                        <td class="text-right"><b>{{$cart->totalPriceFormatted}}</b></td>
                    </tr>
                </tbody>
            </table>

            <a class="btn btn-primary w-100 shadow-none border-0" href="{{route('cart.delivery')}}" role="button">Passer à la livraison</a>
        </div>
        @else
            <div class="col-lg-6">
                <img src="{{asset('images/utils/empty-cart.svg')}}" alt="404">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h3>Votre panier est vide...</h3>
                <a class="btn btn-primary text-white" style="width: fit-content" href="{{route('homepage')}}">
                    Ajouter des produits à mon panier</a>
            </div>
        @endif
    </div>
@endsection
