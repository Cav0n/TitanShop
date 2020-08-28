@extends('default.templates.public')

@section('page.title', 'Merci pour votre commande')

@section('page.content')
    <h2>
        Merci pour votre commande
    </h2>

    <div id="cart-container" class="row mx-0 mb-3">
            <div class="col-lg-6">
                <img src="{{asset('images/utils/thanks.svg')}}" alt="404">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h3>Toute l'équipe vous remercie pour votre achat sur notre boutique.</h3>
                <p>Vous pouvez continuer votre navigation sur le site en appuyant sur le bouton ci-dessous :</p>
                <a class="btn btn-primary text-white mt-2" style="width: fit-content" href="{{route('homepage')}}">
                    Revenir à l'accueil</a>
            </div>
    </div>
@endsection
