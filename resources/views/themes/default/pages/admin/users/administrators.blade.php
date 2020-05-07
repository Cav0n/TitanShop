@extends('templates.admin')

@section('page.title', 'Administrateurs')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.users.administrators') }}">Administrateurs</a>
</p>
@endsection

@section('page.buttons')
    <a class="btn btn-primary mb-3" href="{{ route('admin.users.administrator.create') }}" role="button">Créer un administrateur</a>
@endsection

@section('page.content')
<div class="bg-white p-3 shadow-sm">
    <table class="table border mb-0">
        <thead class="thead thead-light">
            <tr>
                <th class="mobile-only d-table-cell d-md-none">Administrateur</th>
                <th class="d-none d-md-table-cell">Identité</th>
                <th class="d-none d-md-table-cell">Email</th>
                <th class="d-none d-md-table-cell">Pseudo</th>
                <th class="d-none d-md-table-cell">Role</th>

                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($administrators as $administrator)
            <tr>
                <td class="mobile-only d-table-cell d-md-none">
                    <b>{{ $administrator->identity }}</b><br>
                    {{ $administrator->email }}<br>
                    {{ $administrator->pseudo }}<br>
                    {{ $administrator->role }}<br>
                </td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $administrator->identity }}</td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $administrator->email }}</td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $administrator->pseudo }}</td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $administrator->role }}</td>

                <td class="text-right align-middle">
                    <a class="btn btn-primary ml-auto" href="{{ route('admin.users.administrator.edit', ['administrator' => $administrator]) }}" role="button">Éditer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
