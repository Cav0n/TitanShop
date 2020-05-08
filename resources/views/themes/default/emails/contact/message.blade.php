@extends('templates.email')

@section('email.subject', 'Nouveau message depuis le site - ' . $shopName)

@section('email.content')
<h1>Message d'un client</h1>
<p>
    Vous recevez cet email car un client ({{ $customerName }}) vient de vous envoyer
    un email à partir du formulaire de contact du site <b>{{ $shopName }}</b>.
</p>
<p>
    Message du client : <br>
    {!! $customerMessage !!}
</p>

<p>
    Vous pouvez répondre au client avec son adresse email :
    <a href='mailto:{{ $customerEmailAddress }}'>{{ $customerEmailAddress }}</a>
</p>
@endsection
