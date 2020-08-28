<div aria-live="polite" aria-atomic="true" style="position: fixed; min-height: 200px;" class="toast-container">
    <!-- Position it -->
    <div style="position: fixed; top: 20px; right: 20px;">

        <!-- Then put toasts within -->
        <div class="toast {{$class ?? null}}" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="{{$autohide ?? 'true'}}">
            <div class="toast-header">
                <strong class="mr-auto">{{$title ?? setting('shop_name')}}</strong>
                <button class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{$message}}
            </div>
        </div>
    </div>
</div>

<script>
    $('.toast-container').hide();
    $(document).ready(function(){
      $('.toast').toast();
    });
</script>
