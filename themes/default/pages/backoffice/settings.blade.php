@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>Paramètres</h1>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a> /
                <a href='{{ route('admin.settings') }}'>Paramètres</a>
            </div>
        </div>
        @if(isset($settingGroups) && 0 < count($settingGroups))
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
        @endif
    </div>
@endsection
