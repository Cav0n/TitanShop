@extends('templates.admin')

<div class="row justify-content-center">
    <div id="admin-login-container" class="col-12 col-md-10 col-lg-8 col-xl-4 h-100 d-flex flex-column justify-content-center">

        <h1 class="text-center">{{ \App\Setting::valueOrNull('SHOP_NAME') }}</h1>

        @include('themes.default.components.alerts.error')

        <form class="row bg-white shadow-sm py-3 mx-0" action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="col-12 form-group">
                <input type="text" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}" name="login" id="login" placeholder="Email ou pseudo" value="{{ old('login') }}">
            </div>
            <div class="col-12 form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div class="col-12 d-flex justify-content-between">
                <a href="{{ route('index') }}" class="mt-auto text-muted">< Retour à la boutique</a>
                <button type="submit" class="btn btn-outline-primary">Connexion</button>
            </div>
        </form>

    </div>
</div>
