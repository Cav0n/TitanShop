@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex flex-column flex-lg-row justify-content-between">
            <h1>Paramètres</h1>

            <div class="btn-container d-flex">
                <button type="submit" class="save-btn btn btn-success my-3 my-lg-0" form="settings-form">
                    <i class="fas fa-save"></i>
                    Sauvegarder</button>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.settings') }}'>Paramètres</a>
            </div>
        </div>

        <div class="col-lg-12">
            @include('default.components.alerts.success')
            @include('default.components.alerts.errors')
        </div>

        @if(isset($settingGroups) && 0 < count($settingGroups))
        <form id="settings-form" class="col-12 row" method="post" action="{{ route('admin.settings.update') }}">
            @csrf

            @foreach ($settingGroups as $settingGroup)
                @if(count($settingGroup->settings) > 0)
                <div class="col-lg-8">
                    <h2 class="h4">{{ $settingGroup->i18nValue('title') }}</h2>
                    <div class="bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card row">
                        @foreach ($settingGroup->settings as $setting)
                            <div class="col-lg-4">
                                <label for="{{ $setting->code }}" class="pt-1">{{ $setting->i18nValue('title') }}</label>
                            </div>
                            <div class="col-lg-8">
                                {!! $setting->generateInput( ) !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach

        </form>
        @endif
    </div>
@endsection
