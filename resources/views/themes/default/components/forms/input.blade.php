<div class="form-group">
    @isset($label)
        <label for="">{{$label}}</label>
    @endisset

    <input
        type="{{$type ?? 'text'}}"
        class="form-control @if(isset($errors) && $errors->has("$name")) is-invalid @endif {{$class ?? null}}"
        name="{{$name}}"
        id="{{$id ?? $name}}"
        placeholder="{{$placeholder ?? null}}"
        value="{{$value ?? old("$name")}}"
        @isset($help)
            aria-describedby="help{{$name}}"
        @endisset
        @isset($min)
            min={{$min}}
        @endisset
        @isset($max)
            max={{$max}}
        @endisset
        @isset($step)
            step={{$step}}
        @endisset
        @if(isset($required) && $required)
            required="required"
        @endif
        >

    @isset($help)
        <small id="help{{$name}}" class="form-text text-muted {{$help_class ?? null}}">{{$help}}</small>
    @endisset
</div>
