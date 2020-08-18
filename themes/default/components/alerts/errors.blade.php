@if($errors->any())
<div class="alert alert-danger shadow-sm" role="alert">
    @foreach ($errors->all() as $error)
        <p>{{ ucfirst($error)}}</p>
    @endforeach
</div>
@endif
