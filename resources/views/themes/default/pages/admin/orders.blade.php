@extends('templates.admin')

@section('page.title', 'Commandes')

@section('page.content')
<div class="bg-white p-3 shadow-sm">
    <table class="table border mb-0">
        <thead class="thead thead-light">
            <tr>
                <th>Client</th>
                <th class="text-center">Numéro de suivi</th>
                <th class="text-center">Prix</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="align-middle">
                    @if(null === $order->user)
                    {{ $order->shippingAddress->firstname }} {{ $order->shippingAddress->lastname }}
                    @else
                    <a href="#">{{ $order->user->firstname }} {{ $order->user->lastname }}</a>
                    @endif
                </td>
                <td class="text-center align-middle">
                    {{ $order->trackingNumber }}</td>
                <td class="text-center align-middle">
                    {{ $order->totalPriceWithShippingCostsFormatted }}
                    {!! $order->shippingCosts ? '<br>(Dont ' . $order->shippingCostsFormatted . " de frais de port)" : null !!}
                </td>
                <td class="text-right align-middle">
                    <a class="btn btn-primary ml-auto" href="#" role="button">Éditer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
