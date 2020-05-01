<input  type="email"
        class="form-control"
        name="{{ $id }}"
        id="{{ $id }}"
        aria-describedby="help{{ $id }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}">

<small id="help{{ $id }}" class="form-text text-muted">{{ $help }}</small>
