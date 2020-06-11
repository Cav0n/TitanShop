@if (Request::get('debug') == "hooks")
    <div class="w-100 text-center bg-warning border border-dark">
        <p class="py-3">{{$code}}</p>
    </div>
@endif

@foreach (App\Hook::where('code', $code)->get() as $hook)
    @includeIf($hook->view)   
@endforeach