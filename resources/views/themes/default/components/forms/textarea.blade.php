<div class="form-group">
    @isset($label)
        <label for="">{{$label}}</label>
    @endisset

    <textarea
        class="form-control @if(isset($errors) && $errors->has("$name")) is-invalid @endif {{$class ?? null}}"
        name="{{$name}}"
        id="{{$id ?? $name}}"
        placeholder="{{$placeholder ?? null}}"
        rows="{{$rows ?? 5}}"

        @isset($help)
            aria-describedby="help{{$name}}"
        @endisset
        @if(isset($required) && $required)
            required="required"
        @endif
        >{{$value ?? old("$name")}}</textarea>

    @isset($help)
        <small id="help{{$name}}" class="form-text text-muted {{$help_class ?? null}}">{{$help}}</small>
    @endisset
</div>
