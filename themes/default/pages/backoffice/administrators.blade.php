@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>Administrateurs</h1>

            <div class="btn-container d-flex flex-column flex-lg-row flex-wrap justify-content-end">
                <a class="btn btn-primary text-white mr-lg-2 mb-2 mb-lg-0" href="{{route('admin.administrator.create')}}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Créer un nouvel administrateur</a>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.administrators') }}'>Administrateurs</a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="bg-white p-0 mb-3 border shadow-sm backoffice-card">
                @if(isset($administrators) && 0 < count($administrators))
                <table class="table bg-white">
                    <thead class="thead-default">
                    <tr>
                        <th class="d-table-cell d-lg-none">Résumé</th>
                        <th class="d-none d-lg-table-cell">Pseudo</th>
                        <th class="d-none d-lg-table-cell">Email</th>
                        <th class="d-none d-lg-table-cell">Nom</th>
                        <th class="d-none d-lg-table-cell">Prénom</th>
                        <th class="d-none d-lg-table-cell text-right">Date d'inscription</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($administrators as $administrator)
                        <tr>
                            <td class="d-table-cell d-lg-none">
                                <p>{{ $administrator->nickname }} ({{ $administrator->email }})</p>
                                <p><b>{{ $administrator->firstname }} {{ $administrator->lastname }}</b></p>
                                <p>Inscrit le {{ $administrator->created_at->format('d/m/Y à H\hi') }}</p>
                            </td>

                            <td class="d-none d-lg-table-cell">{{ $administrator->nickname }}</td>
                            <td class="d-none d-lg-table-cell">{{ $administrator->email }}</td>
                            <td class="d-none d-lg-table-cell">{{ $administrator->lastname }}</td>
                            <td class="d-none d-lg-table-cell">{{ $administrator->firstname }}</td>
                            <td class="d-none d-lg-table-cell text-right">{{ $administrator->created_at->format('d/m/Y à H\hi') }}</td>

                            <td class="text-right">
                                <a class="btn btn-primary text-white" href="{{route('admin.administrator.edit', ['administrator' => $administrator])}}">
                                    <i class="fas fa-edit"></i>
                                    Editer</a>
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
