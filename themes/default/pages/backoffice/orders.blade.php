@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>Commandes</h1>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.orders') }}'>Commandes</a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="bg-white p-0 mb-3 border shadow-sm backoffice-card">
                @if(isset($orders) && 0 < count($orders))
                <table class="table bg-white">
                    <thead class="thead-default">
                    <tr>
                        <th>ID</th>
                        <th>Commande passée le</th>
                        <th>Client</th>
                        <th>Paiement</th>
                        <th>Status</th>
                        <th class="text-center">Token</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->created_at->format('d/m/Y à H\hi')}}</td>
                            <td>
                                <b>
                                    {!! $order->customer != null
                                        ? "<a href='" . route('admin.customer.show', ['customer' => $order->customer]) . " '>" . $order->customerIdentity . "</a>"
                                        : $order->customerIdentity !!}</b> <br>
                                {{$order->email}} @if ($order->phone)- {{$order->phone}}@endif
                            </td>
                            <td>{{$order->totalPriceFormatted}} - {{$order->paymentMethod}}</td>
                            <td>{!! $order->status->generateBadge() !!}</td>
                            <td class="text-center"><span class="order-token">{{$order->token}}</span></td>

                            <td class="text-right">
                                <a class="btn btn-primary text-white" href="{{route('admin.order.show', ['order' => $order])}}">
                                    <i class="fa fa-eye"></i>
                                    Voir la commande</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else

                <p class="p-3 text-center">Aucune commande n'a été effectuée sur le site pour le moment.</p>

            @endif
            </div>
        </div>
    </div>
@endsection
