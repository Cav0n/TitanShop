@extends('templates.admin')

@section('page.title', 'Catégories')

@section('page.content')
<div class="bg-light p-3 shadow-sm">
    <table class="table border mb-0">
        <thead class="thead thead-light">
            <tr>
                <th>Catégorie</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td class="align-middle">{{ $category->title }}</td>
                <td class="text-right">
                    <a class="btn btn-primary ml-auto" href="#" role="button">
                        Éditer</a>
                    <a class="btn btn-primary ml-2" href="#" role="button">
                        Parcourir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
