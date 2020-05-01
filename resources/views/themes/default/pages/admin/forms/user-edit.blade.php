<form action="{{ route('admin.user.update', ['user' => $user]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpFirstname" value="{{ old('firstname', $user->firstname) }}">
        <small id="helpFirstname" class="form-text text-muted">Le prénom du client</small>
    </div>

    <div class="form-group">
        <label for="lastname">Nom de famille</label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpLastname" value="{{ old('lastname', $user->lastname) }}">
        <small id="helpLastname" class="form-text text-muted">Le nom de famille du client</small>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" aria-describedby="helpEmail" value="{{ old('email', $user->email) }}">
        <small id="helpEmail" class="form-text text-muted">L'email du client</small>
    </div>

    <div class="form-group">
        <label for="phone">Numéro de téléphone</label>
        <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpPhone" value="{{ old('phone', $user->phone) }}">
        <small id="helpPhone" class="form-text text-muted">Le numéro de téléphone du client</small>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="text" class="form-control" name="password" id="password" aria-describedby="helpPassword">
        <small id="helpPassword" class="form-text text-muted">Le mot de passe du client (minimum 8 caractères)</small>
    </div>

    <div class="form-group">
        <label for="password_confirm">Confirmation du mot de passe</label>
        <input type="text" class="form-control" name="password_confirm" id="password_confirm" aria-describedby="helpPasswordConfirm">
        <small id="helpPasswordConfirm" class="form-text text-muted">Retapez le mot de passe pour être certain</small>
    </div>

    <div class="form-group mb-3">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="isVisible" id="isVisible" value="isVisible" @if(old('isActivated')) checked=checked @endif>
                    Le compte client est activé
            </label>
        </div>
    </div>

    <input type="hidden" name="lang" value="FR">

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>
