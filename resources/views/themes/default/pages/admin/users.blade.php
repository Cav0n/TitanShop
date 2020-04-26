@extends('templates.admin')

@section('page.title', 'Clients')

@section('page.content')
<div class="bg-light p-3 shadow-sm">
    <table class="table border mb-0">
        <thead class="thead thead-light">
            <tr>
                <th>Date d'inscription</th>
                <th>Identité</th>
                <th>Email</th>
                <th>Téléphone</th>

                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="align-middle">{{ $user->created_at->format('d/m/Y') }}</td>
                <td class="align-middle">{{ $user->firstname }} {{ $user->lastname }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle">{{ $user->phonePretty ?? 'Non indiqué'}}</td>

                <td class="text-right align-middle">
                    <a class="btn btn-primary ml-auto" href="#" role="button">Éditer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
