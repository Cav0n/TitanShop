@extends('templates.email')

@section('email.subject', 'Votre commande #' . $order->trackingNumber)

@section('email.content')
<h1>Votre commande #{{ $order->trackingNumber }}</h1>
<p>
    Bonjour {{ $order->customerIdentity }}, <br>
    Nous vous remercions pour votre commande <b>#{{ $order->trackingNumber }}</b>.<br>
    Vous pouvez suivre l'état de votre commande sur
    <a href="{{ route('order.tracking') }}">la page de suivi</a>, muni de votre numéro
    de commande.
</p>
@endsection
