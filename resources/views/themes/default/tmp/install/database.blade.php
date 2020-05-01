@extends('templates.install')

@section('page.title', 'Titan Shop - Welcome')

@section('page.content')
    <div id="install" class="container-fluid d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-8 col-lg-6">

                @include('themes.default.components.alerts.error')

                <div class="bg-light border shadow-sm p-3">
                    <h1 class="h4">Bienvenue dans l'installeur de TitanShop !</h1>
                    <p>
                        Vous allez être guidé pendant tout le processus d'installation.<br>
                        Veuillez tout d'abord nous indiquer les informations concernant votre base de données.
                    </p>
                    <form action="{{ route('settings.database.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12 col-md-6 col-xl-4">
                                <label for="base_address">Adresse de la base</label>
                                <input type="text" class="form-control" name="base_address" id="base_address" aria-describedby="helpBaseAddress" value="{{ env('DB_HOST') }}">
                                <small id="helpBaseAddress" class="form-text text-muted">L'adresse peut être "localhost", une adresse IP ou même une adresse URL.</small>
                            </div>
                            <div class="form-group col-12 col-md-6 col-xl-4">
                                <label for="base_name">Nom de la base</label>
                                <input type="text" class="form-control" name="base_name" id="base_name" aria-describedby="helpBaseName" value="{{ env('DB_DATABASE') }}">
                                <small id="helpBaseName" class="form-text text-muted">Le nom de la base de données à utiliser.</small>
                            </div>
                            <div class="form-group col-12 col-md-6 col-xl-4">
                                <label for="base_port">Port de la base</label>
                                <input type="number" class="form-control" name="base_port" id="base_port" aria-describedby="helpBasePort" placeholder="3306" max=65535 step=1 value="{{ env('DB_PORT') }}">
                                <small id="helpBasePort" class="form-text text-muted">Le port de la base de données.</small>
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label for="base_login">Utilisateur de la base</label>
                                <input type="text" class="form-control" name="base_login" id="base_login" aria-describedby="helpBaseLogin" value="{{ env('DB_USERNAME') }}">
                                <small id="helpBaseLogin" class="form-text text-muted">Le login de l'utilisateur de la base de données.</small>
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="base_password">Mot de passe de l'utilisateur de la base</label>
                                <input type="password" class="form-control" name="base_password" id="base_password" aria-describedby="helpBasePassword" value="{{ env('DB_PASSWORD') }}">
                                <small id="helpBasePassword" class="form-text text-muted">Le mot de passe de l'utilisateur de la base de données.</small>
                            </div>

                            <div class="col-6 text-left">
                                <a class="btn btn-outline-dark" href="{{ route('index') }}" role="button">Retour</a>
                            </div>
                            <div class="col-6 text-right">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
