@extends('templates.default')

@section('page.title',  'Espace client - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    @include('themes.default.components.alerts.error')

    <div class="bg-light p-3 shadow-sm">
        <h1>Bienvenue dans votre espace client.</h1>
    </div>
@endsection
