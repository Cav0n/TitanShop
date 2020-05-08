@extends('templates.admin')

@section('page.title', isset($category) ? $category->title : 'Nouvelle catégorie')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.categories') }}">Catégories</a>
    @isset($category)
        {!! $category->adminBreadcrumb !!}
    @else
        {!! $parent ? $parent->adminBreadcrumb : null !!}
        / <a href="#">Nouvelle catégorie</a>
    @endisset
</p>
@endsection

@isset($category)
@section('page.buttons')
    <a class="btn btn-primary mb-3" href="{{ route('category.show', ['category' => $category]) }}" role="button" target="_blank" rel="noopener noreferrer">
        Voir la catégorie</a>
@endsection
@endisset

@section('page.content')
<a class="btn btn-outline-dark mb-3 py-0 px-2" href="{{ route('admin.categories', ['parent_id' => $parent ? $parent->id : null]) }}" role="button">
    Retour</a>

@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    @isset($category)
        @include('themes.default.pages.admin.forms.category-edit', [
            'parent' => $parent,
            'category' => $category
            ])

    @else

        @include('themes.default.pages.admin.forms.category-create', [
            'parent' => $parent
        ])
    @endisset
</div>
@endsection
