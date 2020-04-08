@extends('templates.install')

@section('page.title', 'Titan Shop - Welcome')

@section('page.content')
    <div id="install" class="container-fluid d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-12 text-center">
                <h1>
                    Votre site a été installé avec succés, félicitations ! 🗿</h1>
                    <a class="btn btn-outline-secondary rounded-0 py-1" href="{{ route('index') }}" role="button">
                        Aller à la boutique</a>
            </div>
        </div>
    </div>
@endsection
