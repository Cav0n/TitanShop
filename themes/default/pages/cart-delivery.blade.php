@php
    $cart = session()->get('cart');
@endphp

@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Mon panier - Livraison
    </h2>

    @include('default.components.cart-steps')

    @include('default.components.error')

    <div id="cart-container" class="row mx-0 mb-3">
        <form id="addresses-form" class="col-lg-8 p-3" action="{{route('cart.delivery')}}" method="POST">
            @csrf
            <div id="shipping-address" class="row">
                <div class="col-lg-12">
                    <h3>Livraison</h3>
                </div>

                <div class="form-group col-lg-6">
                    <label for="shipping_lastname">Nom de famille</label>
                    <input type="text" class="form-control" name="shipping[lastname]" id="shipping_lastname" value="{{ null !== old('shipping') ? old('shipping')['lastname'] : null }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="shipping_firstname">Prénom</label>
                    <input type="text" class="form-control" name="shipping[firstname]" id="shipping_firstname" value="{{ null !== old('shipping') ? old('shipping')['firstname'] : null }}">
                </div>
                <div class="form-group col-lg-9">
                    <label for="shipping_street">Rue</label>
                    <input type="text" class="form-control" name="shipping[street]" id="shipping_street" aria-describedby="helpShippingStreet" value="{{ null !== old('shipping') ? old('shipping')['street'] : null }}">
                    <small id="helpShippingStreet" class="form-text text-muted">Numéro et nom de la rue</small>
                </div>
                <div class="form-group col-lg-3">
                    <label for="shipping_zipCode">Code postal</label>
                    <input type="text" class="form-control" name="shipping[zipCode]" id="shipping_zipCode" value="{{ null !== old('shipping') ? old('shipping')['zipCode'] : null }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="shipping_city">Ville</label>
                    <input type="text" class="form-control" name="shipping[city]" id="shipping_city" value="{{ null !== old('shipping') ? old('shipping')['city'] : null }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="shipping_country">Pays</label>
                    <input type="text" class="form-control" name="shipping[country]" id="shipping_country" value="{{ null !== old('shipping') ? old('shipping')['country'] : null }}">
                </div>
            </div>

            <div class="form-check text-center">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="same_billing_address" id="same_billing_address">
                    Adresse de facturation identique
                </label>
            </div>

            <div id="billing-address" class="row">
                <div class="col-lg-12">
                    <h3>Facturation</h3>
                </div>

                <div class="form-group col-lg-6">
                    <label for="billing_lastname">Nom de famille</label>
                    <input type="text" class="form-control" name="billing[lastname]" id="billing_lastname" value="{{ null !== old('billing') ? old('billing')['lastname'] : null }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="billing_firstname">Prénom</label>
                    <input type="text" class="form-control" name="billing[firstname]" id="billing_firstname" value="{{ null !== old('billing') ? old('billing')['firstname'] : null }}">
                </div>
                <div class="form-group col-lg-9">
                    <label for="billing_street">Rue</label>
                    <input type="text" class="form-control" name="billing[street]" id="billing_street" aria-describedby="helpShippingStreet" value="{{ null !== old('billing') ? old('billing')['street'] : null }}">
                    <small id="helpShippingStreet" class="form-text text-muted">Numéro et nom de la rue</small>
                </div>
                <div class="form-group col-lg-3">
                    <label for="billing_zipCode">Code postal</label>
                    <input type="text" class="form-control" name="billing[zipCode]" id="billing_zipCode" value="{{ null !== old('billing') ? old('billing')['zipCode'] : null }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="billing_city">Ville</label>
                    <input type="text" class="form-control" name="billing[city]" id="billing_city" value="{{ null !== old('billing') ? old('billing')['city'] : null }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="billing_country">Pays</label>
                    <input type="text" class="form-control" name="billing[country]" id="billing_country" value="{{ null !== old('billing') ? old('billing')['country'] : null }}">
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

            <button type="submit" class="btn btn-primary w-100 shadow-none border-0" form="addresses-form">
                Passer au paiement</button>
        </div>
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