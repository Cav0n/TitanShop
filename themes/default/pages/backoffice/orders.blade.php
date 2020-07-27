@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 p-0">
            <h1>Commandes</h1>
        </div>
        <div class="col-12 p-0 mb-3 border shadow-sm backoffice-card">
            @if(isset($orders) && 0 < count($orders))
                <table class="table bg-white">
                    <thead class="thead-default">
                    <tr>
                        <th>ID</th>
                        <th>Token</th>
                        <th>Client</th>
                        <th>Paiement</th>
                        <th>Commande passée le</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->token}}</td>
                            <td>
                                <b>{{$order->shippingAddress->firstname}} {{$order->shippingAddress->lastname}}</b> <br>
                                {{$order->email}} @if ($order->phone)- {{$order->phone}}@endif
                            </td>
                            <td>{{$order->paymentMethod}}</td>
                            <td>{{$order->created_at->format('d/m/Y à H\hi')}}</td>
                            <td class="text-right">
                                <a class="btn btn-primary text-white">Voir la commande</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else

                <p>Aucune commande n'a été passé sur la boutique pour le moment.</p>

            @endif

        </div>
    </div>
@endsection
