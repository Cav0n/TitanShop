@extends('templates.admin')

@section('page.title', isset($customer) ? $customer->identity : 'Nouveau client')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.users.customers') }}">Clients</a>

    @isset($product)
    / <a href="{{ route('admin.users.customer.edit', ['customer' => $customer]) }}">{{ $customer->identity }}</a>
    @else
    / <a href="{{ route('admin.users.customer.create') }}">Nouveau client</a>
    @endisset
</p>
@endsection

@section('page.content')
<a class="btn btn-outline-dark mb-3 py-0 px-2" href="{{ route('admin.users.customers') }}" role="button">
    Retour</a>

@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    @isset($customer)
        @include('themes.default.pages.admin.forms.customer-edit', [
            'customer' => $customer
            ])
    @else
        @include('themes.default.pages.admin.forms.customer-create')
    @endisset
</div>
@endsection
