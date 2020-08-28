@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>Clients</h1>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.customers') }}'>Clients</a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="bg-white p-0 mb-3 border shadow-sm backoffice-card">
                @if(isset($customers) && 0 < count($customers))
                <table class="table bg-white">
                    <thead class="thead-default">
                    <tr>
                        <th class="d-table-cell d-lg-none">Résumé</th>
                        <th class="d-none d-lg-table-cell">ID</th>
                        <th class="d-none d-lg-table-cell">Nom</th>
                        <th class="d-none d-lg-table-cell">Prénom</th>
                        <th class="d-none d-lg-table-cell">Date d'inscription</th>
                        <th class="d-none d-lg-table-cell">Date de la dernière commande</th>
                        <th class="d-none d-lg-table-cell">Montant de la dernière commande</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td class="d-table-cell d-lg-none">
                                <p><b>{{ $customer->firstname }} {{ $customer->lastname }}</b></p>
                                <p>Inscrit le {{ $customer->created_at->format('d/m/Y à H\hi') }}</p>
                            </td>

                            <td class="d-none d-lg-table-cell">{{ $customer->id }}</td>
                            <td class="d-none d-lg-table-cell">{{ $customer->lastname }}</td>
                            <td class="d-none d-lg-table-cell">{{ $customer->firstname }}</td>
                            <td class="d-none d-lg-table-cell">{{ $customer->created_at->format('d/m/Y à H\hi') }}</td>
                            <td class="d-none d-lg-table-cell {{ count($customer->orders) <= 0 ? 'text-muted' : null }}">
                                {{ count($customer->orders) > 0 ? $customer->latestOrder->created_at->format('d/m/Y à H\hi') : 'Aucune commande pour ce client' }}
                            </td>
                            <td class="d-none d-lg-table-cell {{ count($customer->orders) <= 0 ? 'text-muted' : null }}">
                                {{ count($customer->orders) > 0 ? $customer->latestOrder->totalPriceFormatted : 'Aucune commande pour ce client' }}
                            </td>

                            <td class="text-right">
                                <a class="btn btn-primary text-white" href="{{route('admin.customer.show', ['customer' => $customer])}}">
                                    <i class="fa fa-eye"></i>
                                    Fiche client</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else

                <p class="p-3 text-center">Aucun client n'est inscrit sur le site pour le moment.</p>

            @endif
            </div>
        </div>
    </div>
@endsection
