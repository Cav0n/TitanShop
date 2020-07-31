@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>Commande de {{$order->customerIdentity}}</h1>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.orders') }}'>Commandes</a> /
                <a href='{{ route('admin.order.show', ['order' => $order]) }}'>Commande de {{$order->customerIdentity}}</a>
            </div>
        </div>

        <div class="col-lg-6">
            <h2 class="h4">Livraison</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="col-12 shipping-address">
                    {!! $order->shippingAddress !!}
                </div>
                <div class="col-12 shipping-price">
                    <p><b>Frais de port :</b> {{$order->shippingPriceFormatted}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h2 class="h4">Facturation</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="col-12 billing-address">
                    {!! $order->billingAddress !!}
                </div>
                <div class="col-12 payment-method">
                    <p><b>Moyen de paiement :</b> {{$order->paymentMethod}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h2 class="h4">Produits</h2>
            <div class="row bg-white p-0 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="col-12 p-0 order-items">
                    <table class="table table-bordered">
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{$item->product->i18nValue('title')}}</td>
                            <td class="text-right">{{$item->product->formattedPrice}}</td>
                            <td class="text-center">x {{$item->quantity}}</td>
                            <td class="text-right">{{$item->priceFormatted}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td class="text-right"></td>
                            <td class="text-right"><b>TOTAL :</b></td>
                            <td class="text-right">{{$order->itemsPriceFormatted}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h2 class="h4">Divers</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="col-12 order-various">
                    <p><b>Statut de la commande : </b> {!! $order->status->generateBadge() !!}</p>
                    <p><b>Commande effectuée le : </b> {{$order->created_at->format('d/m/Y à H\hi')}}</p>
                    <p><b>Message du client :</b> <br>
                        {!! nl2br($order->customerMessage) ?? 'Le client n\'a laissé aucun message pour cette commande.' !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
