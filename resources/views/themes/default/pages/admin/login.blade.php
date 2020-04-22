@extends('templates.admin')

@section('page.content')
    <div class="container-fluid d-flex flex-column justify-content-center" style='min-height:100vh'>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-4">

                @if(!empty($errors->any()))
                @include('themes.default.components.alerts.error', ['errors' => $errors->all()])
                @endif

                <form class="row bg-light shadow-sm py-3" action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="col-12 form-group">
                        <input type="text" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}" name="login" id="login" placeholder="Login" value="{{ old('login') }}">
                    </div>
                    <div class="col-12 form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-outline-secondary">Connexion</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection