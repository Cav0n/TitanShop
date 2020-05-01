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
