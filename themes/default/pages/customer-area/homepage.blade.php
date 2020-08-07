@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Vous êtes connecté.
    </h2>
    <a class="btn btn-danger" href="{{ route('customer-area.logout') }}" role="button">Déconnexion</a>
@endsection
