@extends('default.templates.minimal')

@section('page.title', "Création de votre compte client")

@section('page.content')
    <div id="customer-area-register" class="row">
        <div id="left-side" class="col-md-6 d-flex flex-column justify-content-center">
            <h1 class="text-center mb-0">Création de votre compte client</h1>
            <span class="text-center">{{ setting('shop_name') }}</span>
        </div>
        <div id="right-side" class="col-md-6 d-flex flex-column justify-content-center">
            <form action="{{ route('customer-area.register.handle') }}" method="POST" id="login-form" class="mx-auto">
                @include('default.components.alerts.errors')
                @csrf

                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" name="firstname" id="firstname"
                        value="{{ old('firstname') }}">
                </div>
                <div class="form-group">
                    <label for="lastname">Nom de famille</label>
                    <input type="text" class="form-control" name="lastname" id="lastname"
                        value="{{ old('lastname') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpPasswordConfirmation">
                    <small id="helpPasswordConfirmation" class="form-text text-muted">Vous devez tapez une seconde fois votre mot de passe.</small>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <a class="d-flex" href="{{route('customer-area.login.show')}}">
                        <i class="fas fa-arrow-left d-flex flex-column justify-content-center"></i>
                        <p class="d-flex flex-column justify-content-center ml-2">Connexion</p>
                    </a>
                    <button type="submit" class="btn btn-primary">Créer mon compte</button>
                </div>
            </form>
        </div>
    </div>
@endsection
