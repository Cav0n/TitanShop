@extends('templates.default')

@section('page.title', 'Livraison | Mon panier - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <h1 class="text-center h3">Mon panier - Livraison</h1>

    <div class="row">
        <div class="col-12 col-lg-8 d-flex flex-column">
            <form id="delivery-form" class="mb-3 mb-lg-0 p-0" action="">
                <div class="bg-light shadow-sm row mx-0 py-2">
                    <div class="col-12">
                        <h2 class="h5">Adresse de livraison</h2>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="shipping[lastname]">Nom de famille du destinataire</label>
                        <input type="text" class="form-control" name="shipping[lastname]" id="shipping[lastname]">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="shipping[firstname]">Prénom du destinataire</label>
                        <input type="text" class="form-control" name="shipping[firstname]" id="shipping[firstname]">
                    </div>

                    <div class="form-group col-12">
                        <label for="shipping[street]">Rue</label>
                        <input type="text" class="form-control" name="shipping[street]" id="shipping[street]">
                    </div>
                    <div class="form-group col-12">
                        <label for="shipping[street2]">Complément d'adresse</label>
                        <input type="text" class="form-control" name="shipping[street2]" id="shipping[street2]" aria-describedby="helpStreet2">
                        <small id="helpStreet2" class="form-text text-muted">Numéro d'appartement, nom de résidence...</small>
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="shipping[zipCode]">Code postal</label>
                        <input type="text" class="form-control" name="shipping[zipCode]" id="shipping[zipCode]">
                    </div>
                    <div class="form-group col-12 col-lg-8">
                        <label for="shipping[city]">Ville</label>
                        <input type="text" class="form-control" name="shipping[city]" id="shipping[city]">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-4">
            <div class="bg-light shadow-sm p-3">
                <p>{{ $cart->totalQuantity }} articles : {{ $cart->totalPriceFormatted }}</p>
                <p>Frais de port : {{ \App\Setting::valueOrNull('SHIPPING_COSTS') }}</p>
                <p>Total : {{ $cart->totalPrice }}</p>

                <a class="btn btn-primary w-100 mt-3" href="#" role="button">Valider le panier</a>
            </div>
        </div>
    </div>
@endsection
