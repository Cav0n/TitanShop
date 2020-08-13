<div id="{{$id}}" class="modal {{$class ?? null}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>

                @if (!isset($noClose) || !$noClose)
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @endif
            </div>
            <div class="modal-body">
                <p>{{$text}}</p>
            </div>
            @if (!isset($noFooter) || !$noFooter)
            <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal">{{$validationLabel ?? "Ok"}}</button>
            </div>
            @endif
        </div>
    </div>
</div>
