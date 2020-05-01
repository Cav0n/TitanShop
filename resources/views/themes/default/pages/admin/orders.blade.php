@extends('templates.admin')

@section('page.title', 'Commandes')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.orders') }}">Commandes</a>
</p>
@endsection

@section('page.content')
<div class="bg-white p-3 shadow-sm">
    <table class="table border mb-0">
        <thead class="thead thead-light">
            <tr>
                <th class="mobile-only d-table-cell d-md-none">Commande</th>
                <th class="d-none d-md-table-cell">Client</th>
                <th class="d-none d-md-table-cell text-center">Numéro de suivi</th>
                <th class="d-none d-md-table-cell text-center">Prix</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="mobile-order d-table-cell d-md-none">
                    <b>
                        @if(null === $order->user)
                        {{ $order->shippingAddress->firstname }} {{ $order->shippingAddress->lastname }}
                        @else
                        <a href="#">{{ $order->user->firstname }} {{ $order->user->lastname }}</a>
                        @endif
                    </b> <br>
                    {{ $order->status->code }} <br>
                    Prix total : {{ $order->totalPriceWithShippingCostsFormatted }}
                    {!! $order->shippingCosts ? '<br>(Dont ' . $order->shippingCostsFormatted . " de frais de port)" : null !!}
                </td>
                <td class="align-middle d-none d-md-table-cell">
                    @if(null === $order->user)
                        {{ $order->shippingAddress->firstname }} {{ $order->shippingAddress->lastname }}
                    @else
                        <a href="{{ route('admin.user.edit', ['user' => $order->user]) }}">{{ $order->user->firstname }} {{ $order->user->lastname }}</a>
                    @endif
                </td>
                <td class="text-center align-middle d-none d-md-table-cell">
                    {{ $order->trackingNumber }} <br>
                    {{ $order->status->code }}
                </td>
                <td class="text-center align-middle d-none d-md-table-cell">
                    {{ $order->totalPriceWithShippingCostsFormatted }}
                    {!! $order->shippingCosts ? '<br>(Dont ' . $order->shippingCostsFormatted . " de frais de port)" : null !!}
                </td>
                <td class="text-right align-middle">
                    <a class="btn btn-primary ml-auto" href="{{ route('admin.order.edit', ['order' => $order]) }}" role="button">Éditer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
