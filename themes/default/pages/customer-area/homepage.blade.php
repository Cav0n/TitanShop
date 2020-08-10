@extends('default.templates.public')

@section('page.title', 'Espace client')

@section('page.content')
<div id="customer-area">
    @include('default.components.breadcrumb', ['breadcrumb' => [['link' => route('homepage'), 'title' => 'Accueil'], ['link' => route('customer-area.homepage'), 'title' => 'Espace client']] ])

    <h2 class="mb-0">Votre espace client</h2>
    <p>Bienvenue {{ $customer->firstname }} {{ $customer->lastname }}</p>

    <div class="row my-3 big-links-container">
        <div class="col-lg-4">
            <a class="border p-3 rounded d-flex justify-content-between" href='{{ route('customer-area.password.edit') }}'>
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
            <a class="border p-3 rounded d-flex justify-content-between" href='{{ route('customer-area.orders') }}'>
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
            @include('default.components.alerts.success')
            @include('default.components.alerts.errors')
        </div>

        <div class="col-lg-12">
            <h3 class="h4">Mes informations personnelles</h3>
            <form action="{{ route('customer-area.informations.update') }}" class="row py-3 bg-light border rounded shadow-sm mx-0" method="POST">
                @csrf

                <div class="form-group col-lg-5">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $customer->firstname }}">
                </div>
                <div class="form-group col-lg-5">
                    <label for="lastname">Nom de famille</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $customer->lastname }}">
                </div>
                <div class="form-group col-lg-4">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $customer->phone }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="helpEmail" value="{{ $customer->email }}">
                    <small id="helpEmail" class="form-text text-muted">
                        Une confirmation de changement d'email vous sera envoyé à votre adresse email actuelle
                    </small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <a class="btn btn-light my-3" href="{{ route('customer-area.logout') }}" role="button">
        <i class="fas fa-sign-out-alt"></i>
        Déconnexion</a>
</div>
@endsection
