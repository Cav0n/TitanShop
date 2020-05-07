@extends('templates.admin')

@section('page.title', isset($administrator) ? $administrator->identity : 'Nouveau administrateur')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.users.administrators') }}">Administrateurs</a>

    @isset($product)
    / <a href="{{ route('admin.users.administrator.edit', ['administrator' => $administrator]) }}">{{ $administrator->identity }}</a>
    @else
    / <a href="{{ route('admin.users.administrator.create') }}">Nouveau administrateur</a>
    @endisset
</p>
@endsection

@section('page.content')
<a class="btn btn-outline-dark mb-3 py-0 px-2" href="{{ route('admin.users.administrators') }}" role="button">
    Retour</a>

@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    @isset($administrator)
        @include('themes.default.pages.admin.forms.administrator-edit', [
            'admin' => $administrator
            ])
    @else
        @include('themes.default.pages.admin.forms.administrator-create')
    @endisset
</div>
@endsection
