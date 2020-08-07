@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
<div id="customer-area">
    @include('default.components.breadcrumb', [
        'breadcrumb' => [
            ['link' => route('homepage'), 'title' => 'Accueil'],
            ['link' => route('customer-area.homepage'), 'title' => 'Espace client'],
            ['link' => route('customer-area.password.edit'), 'title' => 'Mon mot de passe']
        ]
    ])

    <h2 class="mb-0">Votre espace client</h2>
    <p>Bienvenue {{ $customer->firstname }} {{ $customer->lastname }}</p>
    <a href="{{ route('customer-area.homepage') }}">
        <i class="fas fa-arrow-left"></i>
        Espace client
    </a>

    <div class="row mt-3">
        <div class="col-lg-12">
            @include('default.components.alerts.success')
            @include('default.components.alerts.errors')
        </div>

        <div class="col-lg-12">
            <h3>Mon mot de passe</h3>
            <form action="{{ route('customer-area.password.update') }}" class="row py-3 bg-light border shadow-sm mx-0" method="POST">
                @csrf

                <div class="form-group col-lg-7">
                    <label for="actual_password">Mot de passe actuel</label>
                    <input type="text" class="form-control" name="actual_password" id="actual_password">
                </div>
                <div class="form-group col-lg-7">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="text" class="form-control" name="new_password" id="new_password">
                </div>
                <div class="form-group col-lg-7">
                    <label for="new_password_confirmation">Confirmation du nouveau mot de passe</label>
                    <input type="text" class="form-control" name="new_password_confirmation" id="new_password_confirmation">
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                </div>
            </form>
        </div>
    </div>

    <a class="btn btn-light my-3" href="{{ route('customer-area.logout') }}" role="button">
        <i class="fas fa-sign-out-alt"></i>
        Déconnexion</a>
</div>
@endsection
