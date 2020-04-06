<div class="col-12 alert alert-danger" role="alert">
    @if (is_array($errors))
        <ul>
            @foreach ($errors as $error)
            <li>{!! ucfirst($error) !!}</li>
            @endforeach
        </ul>
    @else
        <p class="mb-0">{!! ucfirst($errors) !!}</p>
    @endif
</div>
