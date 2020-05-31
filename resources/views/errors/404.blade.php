@extends('templates.default')

@section('page.title', App\Setting::valueOrNull('SHOP_NAME', 'Titan Shop') . ' - 404')

@section('page.content')
    <div id="homepage" class="container-fluid d-flex flex-column justify-content-center my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1>ERREUR 404</h1>

                @if(App\Setting::valueOrNull('SHOP_ACTIVATED'))
                <p>La page que vous recherchez n'existe pas.</p>
                @else
                <p>Le site n'est pas installé. Vous pouvez l'installer en cliquant ici :</p>
                <a class="btn btn-primary" href="{{ route('install') }}" role="button">
                    Installer le site</a>
                @endif
            </div>
        </div>
    </div>
@endsection
