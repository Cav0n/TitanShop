@if (session()->has('success'))
<div class="col-12 alert alert-success" role="alert">
    <ul class="mb-0">
        @foreach (session('success') as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif
