@extends('templates.install')

@section('page.title', 'Titan Shop - Welcome')

@section('page.content')
    <div id="install" class="container-fluid d-flex flex-column justify-content-center">
        <div class="row justify-content-center my-3">
            <div class="col-11 col-sm-10 col-md-8 col-lg-6">

                @include('themes.default.components.alerts.error')

                <div class="bg-light border shadow-sm p-3">
                    <h1 class="h4">Votre boutique en ligne est presque prête !</h1>
                    <p>
                        Il ne nous reste plus qu'à créer votre compte d'administrateur.
                    </p>
                    <form action="{{ route('install.admin.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role" value="SUPER_ADMIN">
                        <input type="hidden" name="next_url" value="{{ route('install.success') }}">
                        <div class="row">
                            <div class="col-12 col-lg-6 form-group">
                                <label for="firstname">Prénom</label>
                                <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" name="firstname" id="firstname" aria-describedby="helpFirstname"
                                    value="{{ old('firstname') }}">
                                <small id="helpFirstname" class="form-text text-muted">Votre prénom.</small>
                            </div>

                            <div class="col-12 col-lg-6 form-group">
                                <label for="lastname">Nom de famille</label>
                                <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" name="lastname" id="lastname" aria-describedby="helpLastname"
                                    value="{{ old('lastname') }}">
                                <small id="helpLastname" class="form-text text-muted">Votre nom de famille.</small>
                            </div>

                            <div class="col-12 col-lg-6 form-group">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" class="form-control {{ $errors->has('pseudo') ? 'is-invalid' : '' }}" name="pseudo" id="pseudo" aria-describedby="helpPseudo"
                                    value="{{ old('pseudo') }}">
                                <small id="helpPseudo" class="form-text text-muted">Il servira à vous connecter.</small>
                            </div>

                            <div class="col-12 col-lg-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" aria-describedby="helpEmail"
                                    value="{{ old('email') }}">
                                <small id="helpEmail" class="form-text text-muted">Il servira à vous connecter,
                                    mais aussi pour recevoir des notifications.</small>
                            </div>

                            <div class="col-12 col-lg-6 form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password" aria-describedby="helpPassword">
                                <small id="helpPassword" class="form-text text-muted">Veuillez entrer un mot de passe d'au moins 8 caractères.</small>
                            </div>

                            <div class="col-12 col-lg-6 form-group">
                                <label for="password_confirmation">Confirmation de mot de passe</label>
                                <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" aria-describedby="helpPasswordConfirmation">
                                <small id="helpPasswordConfirmation" class="form-text text-muted">Retapez votre mot de passe par sécurité.</small>
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
