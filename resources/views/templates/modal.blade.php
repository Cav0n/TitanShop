<div id="@yield('modal.id')"
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-labelledby="@yield('modal.id')"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="@yield('modal.id')">
                    @yield('modal.title')</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield('modal.content')
            </div>
            <div class="modal-footer">
                @yield('modal.footer')
              </div>
        </div>
    </div>
</div>
