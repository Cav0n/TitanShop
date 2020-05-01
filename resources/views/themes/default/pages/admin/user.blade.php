@extends('templates.admin')

@section('page.title', isset($user) ? $user->identity : 'Nouveau client')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.users') }}">Clients</a>
    @isset($product)
    / <a href="{{ route('admin.user.edit', ['user' => $user]) }}">{{ $user->identity }}</a>
    @else
    / <a href="{{ route('admin.user.create') }}">Nouveau client</a>
    @endisset
</p>
@endsection

@section('page.content')
<a class="btn btn-outline-dark mb-3 py-0 px-2" href="{{ route('admin.users') }}" role="button">
    Retour</a>

@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    @isset($user)
        @include('themes.default.pages.admin.forms.user-edit', [
            'user' => $user
            ])
    @else
        @include('themes.default.pages.admin.forms.user-create')
    @endisset
</div>
@endsection
