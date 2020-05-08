@extends('templates.default')

@section('page.title', 'Contact - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
<div id="breadcrumb">
    / <a href="{{ route('index') }}">Accueil</a>
    / <a href="{{ route('contact.show') }}">Contactez-nous</a>
</div>
<h1 class="h3">Contactez-nous</h1>

    @include('themes.default.components.alerts.error')
    @include('themes.default.components.alerts.success')

    <div class="row bg-white shadow-sm p-3 mx-0">
        <form id="contact-container" class="col-12 p-0" method="POST">
            @csrf

            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="name">Votre nom</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-group col-lg-6">
                    <label for="email">Votre adresse email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="helpEmail" value="{{ old('email') }}">
                    <small id="helpEmail" class="form-text text-muted">Nous vous répondrons à cette adresse email</small>
                </div>
            </div>

            <div class="form-group">
                <label for="message">Votre message</label>
                <textarea class="form-control" name="message" id="message" rows=4>{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
@endsection
