@extends('templates.install')

@section('page.title', 'Titan Shop - Welcome')

@section('page.content')
    <div id="install" class="container-fluid d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-12 text-center">
                <h1>
                    Welcome to Titan 🗿</h1>
                    <a class="btn btn-outline-primary rounded-0 py-1" href="{{ route('install.database') }}" role="button">
                        Installer ma boutique</a>
            </div>
        </div>
    </div>
@endsection
