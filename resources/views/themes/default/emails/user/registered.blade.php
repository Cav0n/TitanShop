@extends('templates.email')

@section('email.subject', 'Votre compte ' . $shopName)

@section('email.content')
<h1>Votre compte {{ $shopName }}</h1>
<p>
    Bonjour {{ $user->firstname }} {{ $user->lastname }}, vous venez de créer un compte
    client sur le site <a href="{{ $shopUrl }}">{{ $shopName }}</a>.
</p>
<p>
    Si cela n'est pas le cas, veuillez nous contacter au plus vite à l'adresse
    <a href="mailto:{{ $shopEmail }}">{{ $shopEmail }}</a>.
</p>
@endsection
