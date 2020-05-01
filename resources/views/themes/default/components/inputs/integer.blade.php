<input  type="number"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        class="form-control"
        name="{{ $id }}"
        id="{{ $id }}"
        aria-describedby="help{{ $id }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}">

<small id="help{{ $id }}" class="form-text text-muted">{{ $help }}</small>
