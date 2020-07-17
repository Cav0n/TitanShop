@php
    $cart = session()->get('cart');
@endphp

@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Mon panier
    </h2>

    <div id="cart-container" class="row mx-0 mb-3 p-3">
        @if (0 !== count($cart->items))
        <div id="items-container" class="col-lg-8">
            <h3>Produits</h3>

            <table class="table table-bordered mb-0 bg-white">
                <tbody>
                    @foreach ($cart->items as $item)
                    <tr>
                        <td>{{$item->product->i18nValue('title')}}</td>
                        <td class="text-center">x {{$item->quantity}}</td>
                        <td class="text-right">{{$item->priceFormatted}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group mt-3 mb-0">
                <label for="customer-message">Message pour votre commande</label>
                <textarea class="form-control border-0 rounded-0 shadow-none" name="customer-message" id="customer-message" aria-describedby="helpCustomerMessage" rows=4></textarea>
                <small id="helpCustomerMessage" class="form-text text-muted">Vous pouvez indiquez des précisions pour votre commande ici.</small>
            </div>
        </div>
        <div id='summary' class="col-lg-4">
            <h3>Résumé</h3>
            
            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-left">{{$cart->totalQuantity}} produits :</td>
                        <td class="text-right">{{$cart->totalPriceFormatted}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @else
        <div class="col-12 text-center py-5">
            <p>Votre panier est vide.</p>
        </div>
        @endif
    </div>
@endsection