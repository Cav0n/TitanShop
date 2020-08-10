@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
<div id="customer-area">
    @include('default.components.breadcrumb', [
        'breadcrumb' => [
            ['link' => route('homepage'), 'title' => 'Accueil'],
            ['link' => route('customer-area.homepage'), 'title' => 'Espace client'],
            ['link' => route('customer-area.orders'), 'title' => 'Historique de commande']
        ]
    ])

    <h2 class="mb-0">Votre espace client</h2>
    <p>Bienvenue {{ $customer->firstname }} {{ $customer->lastname }}</p>
    <a href="{{ route('customer-area.homepage') }}">
        <i class="fas fa-arrow-left"></i>
        Espace client
    </a>

    <div class="row mt-3">
        <div class="col-lg-12">
            @include('default.components.alerts.success')
            @include('default.components.alerts.errors')
        </div>

        <div class="col-lg-12">
            <h3>Historique de commande</h3>

            <div class="row bg-light border shadow-sm py-3 mx-0">
            @foreach ($orders as $order)
                <div class="col-lg-12 order-recap">
                    <h4 class="mb-0">Commande du {{$order->created_at->format('d/m/Y à H\hi')}} {!!$order->status->generateBadge()!!}</h4>
                    <p>Prix total des produits : {{$order->itemsPriceFormatted}}</p>
                    <p>Frais de port : {{$order->shippingPriceFormatted}}</p>
                    <p>Prix total de la commande : {{$order->totalPriceFormatted}}</p>
                    <div class="row order-items">
                        @foreach ($order->items as $item)
                            <div class="col-lg-3">
                                <div class="item p-2 border bg-white">
                                    <p>{{$item->title}}</p>
                                    <p>{{$item->unitPriceFormatted}} x {{$item->quantity}} | {{$item->priceFormatted}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

    <a class="btn btn-light my-3" href="{{ route('customer-area.logout') }}" role="button">
        <i class="fas fa-sign-out-alt"></i>
        Déconnexion</a>
</div>
@endsection
