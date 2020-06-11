<div class="form-group">
    @isset($label)
        <label for="">{{$label}}</label>
    @endisset

    <div class="input-group">

        <input
            type="number"
            class="form-control @if(isset($errors) && $errors->has("$name")) is-invalid @endif {{$class ?? null}}"
            name="{{$name}}"
            id="{{$id ?? $name}}"
            placeholder="{{$placeholder ?? null}}"
            value="{{$value ?? old("$name")}}"
            @isset($help)
                aria-describedby="help{{$name}}"
            @endisset
            min={{$step ?? 0.01}}
            @isset($max)
                max={{$max}}
            @endisset
            step={{$step ?? 0.01}}
            @if(isset($required) && $required)
                required="required"
            @endif
        >

        <div class="input-group-append">
            <span class="input-group-text">€</span>
        </div>
    </div>

    @isset($help)
        <small id="help{{$name}}" class="form-text text-muted {{$help_class ?? null}}">{{$help}}</small>
    @endisset
</div>
