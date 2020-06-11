<div class="form-group mb-3">
    <div class="form-check form-check-inline">
        <label class="form-check-label">

            <input
                class="form-check-input {{$class ?? null}}"
                type="checkbox"
                name="{{$name}}"
                id="{{$id ?? $name}}"
                value="{{$value ?? null}}"
                @if(isset($checked) && $checked)
                    checked=checked
                @endif>
                {{$label}}

        </label>
    </div>
</div>
