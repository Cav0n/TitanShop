@extends('default.templates.minimal')

@section('page.title', "Connexion à votre espace client")

@section('page.content')
    <div id="customer-area-login" class="row">
        <div id="left-side" class="col-md-6 d-flex flex-column justify-content-center">
            <h1 class="text-center mb-0">Connexion à votre espace client</h1>
            <span class="text-center">{{ setting('shop_name') }}</span>
        </div>
        <div id="right-side" class="col-md-6 d-flex flex-column justify-content-center">
            <form action="{{ route('customer-area.login.handle') }}" method="POST" id="login-form" class="mx-auto">
                @include('default.components.alerts.errors')
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    <small><a href="{{route('customer-area.register.show')}}">Vous souhaitez créer un compte client ?</a></small>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <small><a href='{{route('customer-area.login.show')}}'>Vous avez oublié votre mot de passe ?</a></small>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <a class="d-flex" href="{{route('homepage')}}">
                        <i class="fas fa-arrow-left d-flex flex-column justify-content-center"></i>
                        <p class="d-flex flex-column justify-content-center ml-2">Retour à la boutique</p>
                    </a>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
@endsection
