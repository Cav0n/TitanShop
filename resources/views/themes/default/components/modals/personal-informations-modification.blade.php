@extends('templates.modal')

@section('modal.id', 'personal-information-modification-modal')

@section('modal.title', 'Modification de vos informations')

@section('modal.content')

    <small>* Les champs avec une astérisque sont obligatoires.</small>
    <form id="personal-informations-form" method="POST" action="{{ route('user.update.personal-informations.post') }}">
        @csrf
        <div class="form-group">
            <label for="firstname">Votre prénom *</label>
            <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $user->firstname }}">
        </div>
        <div class="form-group">
            <label for="lastname">Votre nom de famille *</label>
            <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $user->lastname }}">
        </div>
        <div class="form-group">
            <label for="email">Votre adresse email *</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="phone">Votre numéro de téléphone</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
        </div>
        <input type="submit" id="submit-form" class="d-none" />
    </form>
@endsection

@section('modal.footer')
    <button type="button" class="btn btn-secondary" data-dismiss="modal">
        Annuler</button>
    <button id="save-informations-button" class="btn btn-primary" tabindex="0" data-url="{{ route('user.update.personal-informations.post') }}">
        Sauvegarder</label>
@endsection

@section('modal.scripts')
    <script>
        $(document).ready(function () {
            $('#save-informations-button').on('click', function () {
                let url = $(this).data('url');
                let csrf_token = $('meta[name="csrf-token"]').attr('content');

                let data = {
                    firstname: null,
                    lastname: 'bernard',
                    email: 'fbernard@openstudio.fr',
                    phone: '0783260601',
                    ajax: true,
                }

                $.ajax({
                    url : url,
                    type : 'POST',
                    dataType : 'html',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': csrf_token,
                    },
                    success : function(code_html, statut){
                        console.log(code_html)
                    },
                    error : function(data){
                        console.error(erreur)
                    }
                });
            });
        });
    </script>
@endsection
