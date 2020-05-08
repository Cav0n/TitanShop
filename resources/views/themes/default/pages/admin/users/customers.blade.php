@extends('templates.admin')

@section('page.title', 'Clients')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.users.customers') }}">Clients</a>
</p>
@endsection

@section('page.buttons')
    <a class="btn btn-primary mb-3" href="{{ route('admin.users.customer.create') }}" role="button">Créer un client</a>
@endsection

@section('page.content')
<div class="bg-white p-3 shadow-sm">
    <table class="table border mb-0">
        <thead class="thead thead-light">
            <tr>
                <th class="mobile-only d-table-cell d-md-none">Client</th>
                <th class="d-none d-md-table-cell">Date d'inscription</th>
                <th class="d-none d-md-table-cell">Identité</th>
                <th class="d-none d-md-table-cell">Email</th>
                <th class="d-none d-md-table-cell">Téléphone</th>

                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td class="mobile-only d-table-cell d-md-none">
                    <b>{{ $customer->identity }}</b><br>
                    {{ $customer->email }}<br>
                    {{ $customer->phonePretty ?? 'Non indiqué'}}
                </td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $customer->created_at->format('d/m/Y') }}</td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $customer->identity }}</td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $customer->email }}</td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $customer->phonePretty ?? 'Non indiqué'}}</td>

                <td class="text-right align-middle">
                    <a class="btn btn-primary ml-auto" href="{{ route('admin.users.customer.edit', ['customer' => $customer]) }}" role="button">Éditer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
