@extends('default.templates.backoffice')

@section('page.content')
    <form class="row mx-0" action="{{isset($administrator) ? route('admin.administrator.update', ['administrator' => $administrator]) : route('admin.administrator.store')}}" method="POST">
        @csrf
        <input type="hidden" name="lang" value="fr">

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
                    <input type="text" name="firstname" id="firstname"
                        class="form-control @error('firstname') is-invalid @enderror"
                        value="{{ old('firstname', isset($administrator) ? $administrator->firstname : null) }}">
                </div>
                <div class="form-group col-lg-3">
                    <label for="lastname">Nom de famille</label>
                    <input type="text" name="lastname" id="lastname"
                        class="form-control @error('lastname') is-invalid @enderror"
                        value="{{ old('lastname', isset($administrator) ? $administrator->lastname : null) }}">
                </div>
                <div class="form-group col-lg-3">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', isset($administrator) ? $administrator->email : null) }}">
                </div>
                <div class="form-group col-lg-3">
                    <label for="nickname">Pseudo</label>
                    <input type="text" name="nickname" id="nickname"
                        class="form-control @error('nickname') is-invalid @enderror"
                        value="{{ old('nickname', isset($administrator) ? $administrator->nickname : null)}}">
                </div>
                <div class="form-group col-lg-12">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="isActivated" id="isActivated"
                                {{ (isset($administrator) ? ($administrator->isActivated ? 'checked' : '') : 'checked') }}> Le compte est activé ?
                        </label>
                    </div>
                </div>
            </div>

            <h2 class="h4">Mot de passe</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="form-group col-lg-6">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror">
                </div>
                <div class="form-group col-lg-6">
                    <label for="password_confirmation">Confirmation du mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror">
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
