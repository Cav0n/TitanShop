@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>Commande de
                {!! $order->customer != null
                    ? "<a href='" . route('admin.customer.show', ['customer' => $order->customer]) . " '>" . $order->customerIdentity . "</a>"
                    : $order->customerIdentity !!}
            </h1>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.orders') }}'>Commandes</a> /
                <a href='{{ route('admin.order.show', ['order' => $order]) }}'>Commande de {{$order->customerIdentity}}</a>
            </div>
        </div>

        <div class="col-12 d-flex">
            <div class="status-selector-container">
                <div class="form-group">
                    <label id="status">Status de la commande</label>
                    <select class="form-control custom-select status-selector backoffice-select" name="status" id="status">
                        @foreach (\App\Models\OrderStatus::all() as $status)
                            <option value="{{ $status->id }}" @if($status->id === $order->status->id) selected @endif>
                                {{ $status->i18nValue('title') }}
                            </option>
                        @endforeach
                    </select>
                </div>
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
                    <p><b>Statut de la commande : </b> <span class='order-status-badge'>{!! $order->status->generateBadge() !!}</span></p>
                    <p><b>Commande effectuée le : </b> {{$order->created_at->format('d/m/Y à H\hi')}}</p>
                    <p><b>Numéro de suivi (token) : </b> {{ $order->token }}</p>
                    <p><b>Message du client :</b> <br>
                        {!! nl2br($order->customerMessage) ?? 'Le client n\'a laissé aucun message pour cette commande.' !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page.scripts')
    <script>
        let currentStatusId = {{ $order->status->id }}

        $(document).on('orderStatusUpdated', function (event, data) {
            $('.order-status-badge').html(data.status.badge);
        });

        function updateOrderStatus(selectedStatusId, select = null) {
            $.ajax({
                url : "{{route('admin.order.status.update', ['order' => $order])}}",
                type : 'PATCH',
                dataType : 'json',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    new_status_id: selectedStatusId
                },
                beforeSend : function(){
                    if (select !== null) {
                        select.attr('disabled', 'disabled');
                    }
                },
                success : function(data, status){
                    if (select !== null) {
                        select.removeAttr('disabled');
                    }

                    currentStatusId = data.order_status;
                    $(document).trigger('orderStatusUpdated', {status: data.order_status});
                },
                error : function(data, status, error){
                    if (select !== null) {
                        select.removeAttr('disabled');
                    }

                    console.error('Order status can\'t be updated :' + error);
                }
            });
        }

        $('.status-selector').on('change', function () {
            let selectedStatusId = $(this).val();

            if (currentStatusId === parseInt(selectedStatusId)) {
                return;
            }

            updateOrderStatus(selectedStatusId, $(this))
        });
    </script>
@endsection
