<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <select class="form-control @if(isset($errors) && $errors->has("$name")) is-invalid @endif" name="{{$name}}" id="{{$id ?? $name}}">
        @foreach ($options as $option)
            <option value="{{$option['value']}}"
            @if(isset($option['value']) && $value == $option['value'])
                selected="selected"
            @endif
            @if(isset($option['disabled']) && $option['disabled'])
                disabled="disabled"
            @endif
            >
                {{$option['text']}}
            </option>
        @endforeach
    </select>
</div>
