@extends('templates.admin')

@section('page.title', 'Paramètres')

@section('page.content')
@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        @foreach ($settings as $setting)
        <div class="row @if(!$loop->first) mt-3 @endif">
            <div class="col-lg-3">
                <label for="settings_{{ $setting->code }}">{{ $setting->title }}</label>
            </div>
            <div class="col-9">
                <input type="text" class="form-control" name="settings[{{ $setting->code }}]" id="settings_{{ $setting->code }}" aria-describedby="help{{ $setting->code }}" value="{{ $setting->value }}">
                <small id="help{{ $setting->code }}" class="form-text text-muted">{{ $setting->help }}</small>
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </form>

</div>
@endsection
