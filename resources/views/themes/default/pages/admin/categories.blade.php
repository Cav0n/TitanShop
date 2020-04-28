@extends('templates.admin')

@section('page.title', 'Catégories')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.categories') }}">Catégories</a>
    @isset($category)
        {!! $category->adminBreadcrumb !!}
    @endisset
</p>
@endsection

@section('page.buttons')
    <a class="btn btn-primary" href="{{ route('admin.category.create', ['parent' => $category]) }}" role="button">Créer une catégorie</a>
@endsection

@section('page.content')
<div class="bg-white p-3 shadow-sm">

    @if(0 === count($categories))
    <p class="text-center">Aucune sous catégorie n'existe pour cette catégorie.</p>
    @else
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
                <td class="text-right align-middle">
                    <a class="btn btn-primary ml-auto" href="{{ route('admin.category.edit', ['categoryBase' => $category]) }}" role="button">
                        Éditer</a>
                    <a class="btn btn-primary ml-2" href="{{ route('admin.categories', ['parent_id' => $category->id]) }}" role="button">
                        Parcourir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
