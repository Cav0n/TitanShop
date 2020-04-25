@extends('templates.modal')

@section('modal.id', 'password-modification-modal')

@section('modal.title', 'Modification de votre mot de passe')

@section('modal.content')
    <form id="personal-informations-form" method="POST" action="{{ route('user.update.password.post') }}">
        @csrf

        <div class="form-group">
            <label for="old-password">Mot de passe actuel</label>
            <input type="password" class="form-control" name="old-password" id="old-password" aria-describedby="helpOldPassword">
            <small id="helpOldPassword" class="form-text text-muted">Veuillez entrer votre mot de passe actuel</small>
        </div>

        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpPassword">
            <small id="helpPassword" class="form-text text-muted">Votre nouveau mot de passe</small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmation du nouveau mot de passe</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpPasswordConfirmation">
            <small id="helpPasswordConfirmation" class="form-text text-muted">Cela permet d'être certain de votre nouveau mot de passe</small>
        </div>

        <input type="submit" id="submit-form" class="d-none" />
    </form>
@endsection

@section('modal.footer')
    <button type="button" class="btn btn-secondary" data-dismiss="modal">
        Annuler</button>
    <label class="btn btn-primary" for="submit-form" tabindex="0">
        Sauvegarder</label>
@endsection
