@extends('templates.install')

@section('page.title', 'Titan Shop - Welcome')

@section('page.content')
    <div id="install" class="container-fluid d-flex flex-column justify-content-center">
        <div class="row justify-content-center my-3">
            <div class="col-11 col-sm-10 col-md-8 col-lg-6">

                @include('themes.default.components.alerts.error')

                <div class="bg-light border shadow-sm p-3">
                    <h1 class="h4">Votre base de données a été correctement configuré.</h1>
                    <p>
                        Veuillez à présent indiquer les informations de votre boutique en ligne.
                    </p>
                    <form action="{{ route('settings.updateOrCreate') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="shop_name">Nom de la boutique</label>
                                <input type="text" class="form-control" name="settings[SHOP_NAME]" id="shop_name" aria-describedby="helpShopName"
                                    value="{{ old('settings[SHOP_NAME]', (\App\Setting::valueOrNull('SHOP_NAME')) ) }}">
                                <small id="helpShopName" class="form-text text-muted">Le nom de votre boutique</small>
                            </div>

                            <div class="col-12 form-group">
                                <label for="shop_url">Adresse du site</label>
                                <input type="text" class="form-control" name="settings[SHOP_URL]" id="shop_url" aria-describedby="helpShopUrl"
                                    value="{{ old('settings[SHOP_URL]', (\App\Setting::valueOrNull('SHOP_URL', url('/'))) ) }}">
                                <small id="helpShopUrl" class="form-text text-muted">Il semblerait que l'adresse soit : {{ url('/') }}</small>
                            </div>

                            <div class="col-12 form-group">
                                <label for="shop_email">Email de contact</label>
                                <input type="text" class="form-control" name="settings[SHOP_EMAIL]" id="shop_email" aria-describedby="helpShopEmail"
                                    value="{{ old('settings[SHOP_EMAIL]', (\App\Setting::valueOrNull('SHOP_EMAIL')) ) }}">
                                <small id="helpShopEmail" class="form-text text-muted">L'email de contact de la boutique</small>
                            </div>

                            <div class="col-12 form-group">
                                <label for="shop_description">Description de la boutique</label>
                                <textarea class="form-control" name="settings[SHOP_DESCRIPTION]" id="shop_description" aria-describedby="helpDescription" rows=3>{{ old('settings[SHOP_DESCRIPTION]', (\App\Setting::valueOrNull('SHOP_DESCRIPTION')) ) }}</textarea>
                                <small id="helpDescription" class="form-text text-muted">Ce texte s'affichera sur la page d'accueil.</small>
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
