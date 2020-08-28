@extends('default.templates.public')

@section('page.title', '404 | Page non trouvée')
@section('page.description', 'Si vous êtes arrivé sur cette page c\'est que le contenu que vous rechercher n\'existe pas.')
@section('page.image', asset('images/utils/404.svg'))

@section('page.content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <img src="{{asset('images/utils/404.svg')}}" alt="404">
        </div>
    </div>
@endsection
