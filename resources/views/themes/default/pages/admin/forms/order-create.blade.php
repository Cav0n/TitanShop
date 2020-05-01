<form action="{{ route('admin.order.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Numéro de suivi</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('trackingNumber') }}">
    </div>

    <div class="form-group">
        <label for="shippingCosts">Frais de ports</label>
        <input type="text" class="form-control" name="shippingCosts" id="shippingCosts" aria-describedby="helpShippingCosts" value="{{ old('shippingCosts') }}">
        <small id="helpShippingCosts" class="form-text text-muted">Les frais de ports de la commande</small>
    </div>

    <div class="form-group">
        <label for="user-select">Client</label>
        <select id="user-select" class="custom-select" name="user">
            <option>Veuillez selectionner un client</option>
        </select>
    </div>

    <div class="form-group">
        <label for="shipping-address-select">Adresse de livraison</label>
        <select id="shipping-address-select" class="form-control" name="shippingAddress">
            <option>Veuillez selectionner une adresse</option>
        </select>
    </div>

    <div class="form-group">
        <label for="billing-address-select">Adresse de facturation</label>
        <select id="billing-address-select" class="form-control" name="billingAddress">
            <option>Veuilllez selectionner une adresse</option>
        </select>
    </div>

    <input type="hidden" name="lang" value="FR">

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>
