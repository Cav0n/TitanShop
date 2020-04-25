@extends('templates.default')

@section('page.title', 'Merci pour votre commande - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <div class="bg-light shadow-sm p-3">
        <h1 class="h3">Merci pour votre commande</h1>

        @auth
        <p>
            Vous pouvez retrouver votre commande dans votre
            <a href="{{ route('customer-area.index') }}">espace client.</a>
        </p>
        @endauth

        <p>
            Pour suivre l'avancement de votre commande veuillez noter le numéro de suivi
            de celle ci : <b>{{ '#' . $order->trackingNumber }}</b>.<br>
        </p>
    </div>
@endsection
