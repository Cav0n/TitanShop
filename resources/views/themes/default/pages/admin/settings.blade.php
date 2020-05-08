@extends('templates.admin')

@section('page.title', 'Paramètres')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.settings') }}">Paramètres</a>
</p>
@endsection

@section('page.content')
@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        @foreach ($settings as $setting)
        <div class="row @if(!$loop->first) mt-3 @endif">
            <div class="col-12 col-lg-3">
                <label for="settings_{{ $setting->code }}">{{ $setting->title }}</label>
            </div>
            <div class="col-12 col-lg-9">

                {{ $setting->input }}

            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </form>

</div>
@endsection
