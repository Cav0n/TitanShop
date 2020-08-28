@if(Session::has('success'))
<div class="alert alert-success shadow-sm" role="alert">
    <p>{!! Session::get('success') !!}</p>
</div>
@endif

<script>
setTimeout(function() {
    $('.alert-success').slideUp('fast');
}, 3000); // <-- time in milliseconds
</script>
