@php
    $cart = session()->get('cart');
@endphp

@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Mon panier - Paiement
    </h2>

    @include('default.components.error')

    <div id="cart-container" class="row mx-0 mb-3">
        @if (0 !== count($cart->items))
        <form id="payment-container" class="col-lg-8 p-3" action="" method="POST">
            @csrf

            <div id="payment-container" class="row">
                <div class="col-lg-12">
                    <h3>Paiement</h3>
                </div>
            </div>

            <div class="form-group mt-3 mb-0 pt-3 border-top border-dark">
                <label for="customer-message">Message pour votre commande</label>
                <textarea class="form-control" name="customer-message" id="customer-message" aria-describedby="helpCustomerMessage" rows=4></textarea>
                <small id="helpCustomerMessage" class="form-text text-muted">Vous pouvez indiquez des précisions pour votre commande ici.</small>
            </div>
        </form>
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

            <button type="submit" class="btn btn-primary w-100 shadow-none border-0" form="addresses-container">
                Passer au paiement</button>
        </div>
        @else
        <div class="col-12 text-center py-5">
            <p>Votre panier est vide.</p>
        </div>
        @endif
    </div>
@endsection

@section('page.scripts')
    <script>
        $('#same_billing_address').change(function () {
            if ($(this).is(":checked")) {
                $('#billing-address').hide();
            } else {
                $('#billing-address').show();
            }
        });
    </script>
@endsection