@foreach (App\Hook::where('code', $code)->get() as $hook)
    @includeIf($hook->view)   
@endforeach