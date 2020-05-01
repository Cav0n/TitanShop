<div class="input-group">

    <input  class="form-control"
            type="number"
            name="{{ $id }}"
            aria-describedby="help{{ $id }}"
            min="0"
            step="0.01"
            max="{{ $max }}"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}">

    <div class="input-group-append">
        <span class="input-group-text">€</span>
    </div>
</div>

<small id="help{{ $id }}" class="form-text text-muted">{{ $help }}</small>
