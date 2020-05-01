@extends('templates.admin')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
</p>
@endsection

@section('page.content')
<div class="bg-white p-3 shadow-sm">
    <h1 class="text-center">Bienvenue dans votre backoffice 🗿</h1>
</div>
@endsection
