<form action="{{ route('admin.users.administrator.update', ['administrator' => $administrator]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpFirstname" value="{{ old('firstname', $administrator->firstname) }}">
        <small id="helpFirstname" class="form-text text-muted">Le prénom de l'administrateur</small>
    </div>

    <div class="form-group">
        <label for="lastname">Nom de famille</label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpLastname" value="{{ old('lastname', $administrator->lastname) }}">
        <small id="helpLastname" class="form-text text-muted">Le nom de famille de l'administrateur</small>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" aria-describedby="helpEmail" value="{{ old('email', $administrator->email) }}">
        <small id="helpEmail" class="form-text text-muted">L'email de l'administrateur</small>
    </div>

    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo" aria-describedby="helpPseudo" value="{{ old('pseudo', $administrator->pseudo) }}">
        <small id="helpPseudo" class="form-text text-muted">L'administrateur pourra utiliser son email ou son pseudo pour se connecter</small>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="text" class="form-control" name="password" id="password" aria-describedby="helpPassword">
        <small id="helpPassword" class="form-text text-muted">Le mot de passe de l'administrateur (minimum 8 caractères)</small>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmation du mot de passe</label>
        <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpPasswordConfirm">
        <small id="helpPasswordConfirm" class="form-text text-muted">Retapez le mot de passe pour être certain</small>
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select id="role" class="custom-select" name="role">

            @foreach (\App\Admin::ROLES as $role)
                <option @if($role === $administrator->role) selected=true @endif>{{ $role }}</option>
            @endforeach

        </select>
    </div>

    <div class="form-group mb-3">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="isActivated" id="isActivated" value="isActivated" @if(old('isActivated', $administrator->isActivated)) checked=checked @endif>
                    Le compte administrateur est activé
            </label>
        </div>
    </div>

    <input type="hidden" name="lang" value="FR">

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>
