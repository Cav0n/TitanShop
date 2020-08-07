@extends('default.templates.minimal')

@section('page.content')
    <div class="row" style="height:100vh;">
        <div class="left-side col-lg-6">

        </div>
        <div class="right-side col-lg-6 row d-flex flex-column justify-content-center">
            <form action="{{ route('customer-area.login.handle') }}" method="POST" class="col-lg-6 mx-auto">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="text" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-success">Connexion</button>
            </form>
        </div>
    </div>
@endsection
