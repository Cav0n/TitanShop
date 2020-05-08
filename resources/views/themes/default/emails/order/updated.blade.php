@extends('templates.email')

@section('email.subject', $subject)

@section('email.content')
<h1>{{ $subject }}</h1>
<p>
    Bonjour {{ $order->customerIdentity }}, <br>
    Nous vous informons que le status de votre commande <b>#{{ $order->trackingNumber }}</b>
    vient d'être mis à jour. Elle est maintenant <b>{{ strtolower($order->status->title) }}</b>.
</p>
@endsection
