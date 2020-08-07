@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
<div id="customer-area">
    <h2 class="mb-0">Votre espace client</h2>
    <p>Bienvenue {{ $customer->firstname }} {{ $customer->lastname }}</p>

    <div class="row my-3 big-links-container">
        <div class="col-lg-4">
            <a class="border p-3 rounded d-flex justify-content-between" href='{{ route('customer-area.homepage') }}'>
                <div class="left d-flex flex-column justify-content-center">
                    <p>Mon mot de passe</p>
                    <small>Modifier mon mot de passe.</small>
                </div>
                <div class="right d-flex flex-column justify-content-center">
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a class="border p-3 rounded d-flex justify-content-between" href='{{ route('customer-area.homepage') }}'>
                <div class="left d-flex flex-column justify-content-center">
                    <p>Historique de commandes</p>
                    <small>Vous avez effectué {{ count($customer->orders) }} commandes.</small>
                </div>
                <div class="right d-flex flex-column justify-content-center">
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3>Mes informations personnelles</h3>
        </div>
    </div>

    <a class="btn btn-light mb-2" href="{{ route('customer-area.logout') }}" role="button">Déconnexion</a>
</div>
@endsection
