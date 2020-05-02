@extends('templates.default')

@section('page.title', 'Suivre une commande - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <h1 class="text-center h3">Suivre une commande</h1>

    <div class="row bg-white shadow-sm p-3 mx-0">
        <div id="search-container" class="col-12">
            <div class="input-group">
                <input id="trackingNumber" class="form-control" type="text" name="trackingNumber">
                <div class="input-group-append">
                    <button id="search-order" type="button" class="input-group-text" data-url="{{ route('api.order.tracking') }}">
                        Chercher la commande</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#search-order').on('click', function () {
            let trackingNumber = $('#trackingNumber');
            let url = $(this).data('url') + '?t=' + trackingNumber.val();

            fetch(url)
            .then((resp) => resp.json())
            .then(function(data) {
                $('.order-minimal').remove();
                $('.invalid-feedback').remove();
                trackingNumber.removeClass('is-invalid');


                if (undefined !== data.error) {
                    throw data.error
                }

                $('#search-container').append(data.view);
            })
            .catch(function(error) {
                console.error(error.message)

                trackingNumber.addClass('is-invalid');
                $('#search-container .input-group').append(error.feedback);
            });
        });
    </script>
@endsection
