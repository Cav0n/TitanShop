@extends('templates.cart')

@section('cart.title', 'Mon panier - Livraison')

@section('cart.breadcrumb')
    / <a href="{{ route('cart.delivery') }}">Livraison</a>
@endsection

@section('cart.content')
<form id="delivery-form" class="mb-3 mb-lg-0 p-0" action="{{ route('cart.delivery.add-addresses') }}" method="POST">
    @csrf

    <div class="bg-white shadow-sm row mx-0 py-2">
        <div class="col-12">
            <h2 class="h5">Adresse de livraison</h2>
        </div>

        <div class="form-group col-12 col-lg-6">
            <label for="shipping_lastname">Nom de famille du destinataire</label>
            <input type="text" class="form-control" name="shipping[lastname]" id="shipping_lastname" value="{{ old('shipping')['lastname'] }}">
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="shipping_firstname">Prénom du destinataire</label>
            <input type="text" class="form-control" name="shipping[firstname]" id="shipping_firstname" value="{{ old('shipping')['firstname'] }}">
        </div>

        <div class="form-group col-12">
            <label for="shipping_street">Rue</label>
            <input type="text" class="form-control" name="shipping[street]" id="shipping_street" value="{{ old('shipping')['street'] }}">
        </div>
        <div class="form-group col-12">
            <label for="shipping_street2">Complément d'adresse</label>
            <input type="text" class="form-control" name="shipping[street2]" id="shipping_street2" aria-describedby="helpStreet2" value="{{ old('shipping')['street2'] }}">
            <small id="helpStreet2" class="form-text text-muted">Numéro d'appartement, nom de résidence...</small>
        </div>
        <div class="form-group col-12 col-lg-4">
            <label for="shipping_zipCode">Code postal</label>
            <input type="text" class="form-control" name="shipping[zipCode]" id="shipping_zipCode" value="{{ old('shipping')['zipCode'] }}">
        </div>
        <div class="form-group col-12 col-lg-8">
            <label for="shipping_city">Ville</label>
            <input type="text" class="form-control" name="shipping[city]" id="shipping_city" value="{{ old('shipping')['city'] }}">
        </div>
        <div class="form-group col-12 text-center">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input id="same-addresses-checkbox" class="form-check-input" type="checkbox" name="sameBillingAddress" value="sameBillingAddress" checked>
                        Adresse de facturation identique
                </label>
            </div>
        </div>
    </div>

    <div id="billing-address" class="bg-white shadow-sm row mx-0 py-2">
        <div class="col-12">
            <h2 class="h5">Adresse de facturation</h2>
        </div>

        <div class="form-group col-12 col-lg-6">
            <label for="billing_lastname">Nom de famille</label>
            <input type="text" class="form-control" name="billing[lastname]" id="billing_lastname" value="{{ old('billing')['lastname'] }}">
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="billing_firstname">Prénom</label>
            <input type="text" class="form-control" name="billing[firstname]" id="billing_firstname" value="{{ old('billing')['firstname'] }}">
        </div>

        <div class="form-group col-12">
            <label for="billing_street">Rue</label>
            <input type="text" class="form-control" name="billing[street]" id="billing_street" value="{{ old('billing')['street'] }}">
        </div>
        <div class="form-group col-12">
            <label for="billing_street2">Complément d'adresse</label>
            <input type="text" class="form-control" name="billing[street2]" id="billing_street2" aria-describedby="helpStreet2" value="{{ old('billing')['street2'] }}">
            <small id="helpStreet2" class="form-text text-muted">Numéro d'appartement, nom de résidence...</small>
        </div>
        <div class="form-group col-12 col-lg-4">
            <label for="billing_zipCode">Code postal</label>
            <input type="text" class="form-control" name="billing[zipCode]" id="billing_zipCode" value="{{ old('billing')['zipCode'] }}">
        </div>
        <div class="form-group col-12 col-lg-8">
            <label for="billing_city">Ville</label>
            <input type="text" class="form-control" name="billing[city]" id="billing_city" value="{{ old('billing')['city'] }}">
        </div>
    </div>

    <input type="submit" id="submit-form" class="d-none" />
</form>
@endsection

@section('cart.summary.next-button')
<label class="btn btn-primary w-100 mt-3 mb-0" for="submit-form" tabindex="0">
    Passer au paiement</label>
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        let sameAddressCheckbox = $('#same-addresses-checkbox');
        let billingAddressContainer = $('#billing-address');

        function checkIfBillingAddressHasToBeDisplayed() {
            console.log('test');
            if (sameAddressCheckbox.is(":checked")) {
                billingAddressContainer.hide();
            } else {
                billingAddressContainer.show();
            }
        }

        sameAddressCheckbox.change(function () {
            checkIfBillingAddressHasToBeDisplayed();
        });

        checkIfBillingAddressHasToBeDisplayed();
    })
</script>
@endsection
