@extends('templates.admin')

@section('page.title', isset($order) ? 'Commande de ' . $order->customerIdentity : 'Nouvelle commande')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.orders') }}">Commandes</a>
    @isset($order)
    / <a href="{{ route('admin.order.edit', ['order' => $order]) }}">Commande de {{ $order->customerIdentity }}</a>
    @else
    / <a href="{{ route('admin.order.create') }}">Nouvelle commande</a>
    @endisset
</p>
@endsection

@isset($order)
@section('page.buttons')
    <div class="form-group my-0 h-100 d-flex flex-column justify-content-center ">
        <select id="order-status" class="custom-select" name="order-status" style="background-color: {{ $order->status->color }}" data-url="{{ route('admin.order.updateStatus', ['order' => $order]) }}">
            @foreach ($orderStatus as $status)
                <option value="{{ $status->code }}" @if($order->status->code === $status->code) selected="true" @endif>
                    {{ $status->title }}</option>
            @endforeach
        </select>
    </div>
@endsection
@endisset

@section('page.content')
<a class="btn btn-outline-dark mb-3 py-0 px-2" href="{{ route('admin.orders') }}" role="button">
    Retour</a>

@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    @isset($order)
        @include('themes.default.pages.admin.forms.order-edit', [
            'order' => $order
            ])
    @else
        @include('themes.default.pages.admin.forms.order-create')
    @endisset
</div>
@endsection

@isset($order)
    @section('scripts')
        <script>
            let orderStatusSelect = $('#order-status');

            orderStatusSelect.change(function () {
                if (confirm('Êtes-vous certain de vouloir modifier le status de cette commande ?')) {
                    changeOrderStatus(
                        orderStatusSelect.data('url'),
                        orderStatusSelect.val(),
                        orderStatusSelect
                    );
                }
            });

            function changeOrderStatus(url, statusCode, orderStatusSelect) {
                let token = $('meta[name="csrf-token"]').attr('content');

                fetch(url, {
                    method: "POST",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-Token': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 'statusCode' : statusCode })
                })
                .then((resp) => resp.json())
                .then(function(data) {
                    if (undefined !== data.error) {
                        throw data.error
                    }
                    console.log(data);
                    orderStatusSelect.css('background-color', data.color);
                })
                .catch(function(error) {
                    console.error(error.message)
                });
            }
        </script>
    @endsection
@endisset
