@extends('templates.default')

@section('page.title',  'Espace client - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    @hook(['code' => 'customer-area.register.top'])

    <div id="breadcrumb">
        / <a href="{{ route('index') }}">Accueil</a>
        / <a href="{{ route('customer-area.index') }}">Espace client</a>
        / <a href="{{ route('customer-area.register') }}">Enregistrement</a>
    </div>
    <h1 class="h3">Espace client - Enregistrement</h1>

    @include('themes.default.components.alerts.error')
    @include('themes.default.components.alerts.success')

    <form class="bg-white p-3 shadow-sm" method="POST">
        @csrf
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpFirstname">
            <small id="helpFirstname" class="form-text text-muted">Votre prénom est obligatoire</small>
        </div>
        <div class="form-group">
            <label for="lastname">Nom de famille</label>
            <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpLastname">
            <small id="helpLastname" class="form-text text-muted">Votre nom de famille est obligatoire</small>
        </div>
        <div class="form-group">
            <label for="phone">Numéro de téléphone</label>
            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpPhone">
            <small id="helpPhone" class="form-text text-muted">Votre numéro de téléphone est facultatif</small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpEmail">
            <small id="helpEmail" class="form-text text-muted">Votre email est obligatoire, il vous servira pour vous connecter</small>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpPassword">
            <small id="helpPassword" class="form-text text-muted">Votre mot de passe est obligatoire</small>
        </div>
        <button type="submit" class="btn btn-primary">Créer mon compte</button>
    </form>

    @hook(['code' => 'customer-area.register.bottom'])
@endsection
