@extends('default.templates.backoffice')

@section('page.content')
    <form class="row mx-0" action="{{isset($administrator) ? route('admin.administrator.update', ['administrator' => $administrator]) : route('admin.administrator.store')}}" method="POST">
        @csrf

        <div class="col-12 d-flex flex-column flex-lg-row justify-content-between">
            <h1>{{isset($administrator) ? $administrator->firstname . ' ' . $administrator->lastname : "Nouvel administrateur"}}</h1>

            <div class="btn-container d-flex flex-column flex-lg-row">
                <button type="submit" class="btn btn-success mb-2">
                    <i class="fas fa-save"></i>
                    Sauvegarder</button>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a>
                / <a href='{{ route('admin.administrators') }}'>Administrateurs</a>

                @if (isset($administrator))
                / <a href='{{ route('admin.administrator.edit', ['administrator' => $administrator]) }}'>
                    {{ $administrator->firstname }} {{ $administrator->lastname }}
                </a>
                @endif

                @if (!isset($administrator))
                / <a href='{{ route('admin.administrator.create') }}'>Nouvel administrateur</a>
                @endif
            </div>
        </div>

        <div class="col-lg-12">
            @include('default.components.alerts.success')
            @include('default.components.alerts.errors')
        </div>

        <div class="col-lg-8">
            <h2 class="h4">Informations</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="form-group col-lg-3">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{{ isset($administrator) ? $administrator->firstname : null }}">
                </div>
                <div class="form-group col-lg-3">
                    <label for="lastname">Nom de famille</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{ isset($administrator) ? $administrator->lastname : null }}">
                </div>
                <div class="form-group col-lg-3">
                    <label for="email">Adresse email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ isset($administrator) ? $administrator->email : null }}">
                </div>
                <div class="form-group col-lg-3">
                    <label for="nickname">Pseudo</label>
                    <input type="text" class="form-control" name="nickname" id="nickname" value="{{ isset($administrator) ? $administrator->nickname : null }}">
                </div>
                <div class="form-group col-lg-12">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="isActivated" id="isActivated" {{ (isset($administrator) ? ($administrator->isActivated ? 'checked' : '') : 'checked') }}> Le compte est activé ?
                        </label>
                    </div>
                </div>
            </div>

            <h2 class="h4">Mot de passe</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="form-group col-lg-6">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group col-lg-6">
                    <label for="password_confirmation">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="">
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <h2 class="h4">Logs</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <p>Bientôt disponible...</p>
            </div>
        </div>
    </form>
@endsection
