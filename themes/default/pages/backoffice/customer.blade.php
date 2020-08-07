@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>{{ $customer->firstname }} {{ $customer->lastname }}</h1>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.customers') }}'>Clients</a> /
                <a href='{{ route('admin.customer.show', ['customer' => $customer]) }}'>{{ $customer->firstname }} {{ $customer->lastname }}</a>
            </div>
        </div>

        <div class="col-lg-6">
            <h2 class="h4">Identité</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="col-12 identity">
                   <p>Nom : {{ $customer->firstname }}</p>
                   <p>Prénom : {{ $customer->lastname }}</p>
                   <p>Adresse e-mail : <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></p>

                   @if(null !== $customer->phone)
                    <p>Numéro de téléphone : <a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a></p>
                   @endif
                </div>
            </div>
        </div>

        @if (count($customer->orders) > 0)
        <div class="col-lg-6">
            <h2 class="h4">Commandes de ce client</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                @foreach ($customer->orders as $order)
                    <div class="col-12 row mx-0 order-tiny">
                        <div class="col-lg-5">
                            <a href="{{ route('admin.order.show', ['order' => $order]) }}">Commande du {{ $order->created_at->format('d/m/Y à H\hi') }}</a>
                            <p>Prix total des produits : {{ $order->itemsPriceFormatted }}</p>
                            <p>Frais de port : {{ $order->shippingPriceFormatted }}</p>
                            <p>Prix total de la commande : {{ $order->totalPriceFormatted }}</p>
                        </div>

                        <div class="col-lg-7 border-left border-dark">
                            <p>Produits commandés :</p>
                            <ul class="order-items-list mb-0">
                                @foreach ($order->items as $item)
                                <li>{{ $item->title }} x {{ $item->quantity }} | <b>{{ $item->priceFormatted }}</b></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
@endsection
