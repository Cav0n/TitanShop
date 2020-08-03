<div id="{{$id}}" class="modal {{$class ?? null}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-danger">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$text}}</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger validate-btn">{{$validationLabel ?? "Ok"}}</button>
                <button class="btn btn-light" data-dismiss="modal">{{$cancelLabel ?? "Annuler"}}</button>
            </div>
        </div>
    </div>
</div>
