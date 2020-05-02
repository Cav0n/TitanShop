<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau message depuis le site - {{ $shopName }}</title>
</head>
<body>
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
</body>
</html>
