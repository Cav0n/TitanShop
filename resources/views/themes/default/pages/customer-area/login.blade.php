@extends('templates.default')

@section('page.title',  'Espace client - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <div id="breadcrumb">
        / <a href="{{ route('index') }}">Accueil</a>
        / <a href="{{ route('customer-area.index') }}">Espace client</a>
        / <a href="{{ route('customer-area.login') }}">Connexion</a>
    </div>
    <h1 class="h3">Espace client - Connexion</h1>

    @include('themes.default.components.alerts.error')

    <form class="bg-white p-3 shadow-sm" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpEmail">
            <small id="helpEmail" class="form-text text-muted"><a href='{{ route('customer-area.register') }}'>
                Vous n'avez pas de compte ?</a></small>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpPassword">
            <small id="helpPassword" class="form-text text-muted">Votre mot de passe</small>
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
@endsection
