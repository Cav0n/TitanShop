@extends('default.templates.minimal')

@section('page.title', 'Administration')

@section('page.content')
    <div class="d-flex flex-column justify-content-center mh-100">
        <div class="row justify-content-center">
            <div class="col-lg-4">   
                <h1>Titan Shop</h1>
                @include('default.components.error')
                <form action="{{route('admin.login')}}" method="POST">
                    @csrf
                    <input type="text" class="form-control mb-3" name="login" id="login" placeholder="Email ou pseudo" value="{{old('login')}}">
                    <input type="password" class="form-control mb-3" name="password" id="password" placeholder="Mot de passe">

                    <div class="d-flex justify-content-between">
                        <a href="{{route('homepage')}}" class="text-muted my-auto">Retour à la boutique</a>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection