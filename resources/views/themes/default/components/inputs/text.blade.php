<textarea   class="form-control"
            name="{{ $id }}"
            id="{{ $id }}"
            aria-describedby="help{{ $id }}"
            placeholder="{{ $placeholder }}">{{ $value }}</textarea>

<small id="help{{ $id }}" class="form-text text-muted">{{ $help }}</small>
