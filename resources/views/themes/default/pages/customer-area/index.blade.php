@extends('templates.default')

@section('page.title',  'Espace client - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    @include('themes.default.components.alerts.error')
    @include('themes.default.components.alerts.success')

    <div id="customer-area-container" class="bg-light p-3 shadow-sm row mx-0">
        <div id="customer-area-title" class="border-bottom pb-2 col-12 px-0">
            <h1 class="h2">Bienvenue dans votre espace client</h1>
        </div>

        <div id="user-informations-container" class="col-12 col-lg-6 mt-3 px-0">
            <h2 class="h4">Mes informations personnelles</h2>
            <p>Prénom : {{ Auth::user()->firstname }}</p>
            <p>Nom de famille : {{ Auth::user()->lastname }}</p>
            <p>Adresse email : {{ Auth::user()->emailPretty }}</p>
            <p>Numéro de téléphone : {{ Auth::user()->phonePretty }}</p>
            <button type="button" class="btn btn-primary mt-2 show-modal"
                data-url="{{ route('customer-area.modal.personal-informations') }}"
                data-modal-id="personal-information-modification-modal">
                Modifier mes informations</button>
        </div>

        <div id="user-password-container" class="col-12 col-lg-6 mt-3 px-0">
            <h2 class="h4">Mon mot de passe</h2>
            <p>Vous pouvez modifier votre mot de passe si vous le souhaitez.</p>
            <button type="button" class="btn btn-primary mt-2 show-modal"
                data-url="{{ route('customer-area.modal.password') }}"
                data-modal-id="password-modification-modal">
                Modifier mon mot de passe</button>
        </div>

        <div id="logout-button-container" class="col-12 mt-3 px-0">
            <a class="btn btn-secondary" href="{{ route('customer-area.logout') }}" role="button">
                Déconnexion</a>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $('.show-modal').on('click', function () {
                let url = $(this).data('url');
                let modalId = '#' + $(this).data('modal-id');
                let parent = $(this).parent();

                if ($(modalId).length) {
                    $(modalId).modal('show');
                    return;
                }

                $.ajax({
                    url : url,
                    type : 'GET',
                    dataType : 'html',
                    success : function(code_html, statut){
                        console.log(code_html)
                        parent.append(code_html);
                        $(modalId).modal('show');
                    },
                    error : function(resultat, statut, erreur){
                        console.error(erreur)
                    }
                });
            });


        });
    </script>
@endsection
