@extends('templates.admin')

@section('page.title', $category->title)

@section('page.content')
<div class="mb-3">
    {!! $category->adminBreadcrumb !!}
</div>

<a class="btn btn-outline-dark mb-3 py-0 px-2" href="{{ route('admin.categories', ['parent_id' => $category->parent ? $category->parent->id : null]) }}" role="button">Retour</a>

@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    <form action="{{ route('admin.category.update', ['categoryBase' => $category]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $category->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows=4>{{ $category->description }}</textarea>
        </div>

        <input type="hidden" name="lang" value="FR">
        <input type="hidden" name="parent" value="{{ $category->parent ? $category->parent->id : null }}">

        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </form>

</div>
@endsection
