@extends('templates.default')

@section('page.title', 'Suivre une commande - ' . App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    @hook(['code' => 'public.order-tracking.top'])

    <div id="breadcrumb">
        / <a href="{{ route('index') }}">Accueil</a>
        / <a href="{{ route('order.tracking') }}">Suivre une commande</a>
    </div>
    <h1 class="h3">Suivre une commande</h1>

    <div class="row bg-white shadow-sm p-3 mx-0">
        <div id="search-container" class="col-12 p-0">
            <div class="input-group">
                <input id="trackingNumber" class="form-control" type="text" name="trackingNumber">
                <div class="input-group-append">
                    <button id="search-order" type="button" class="input-group-text" data-url="{{ route('api.order.tracking') }}">
                        Chercher la commande</button>
                </div>
            </div>
        </div>
    </div>

    @hook(['code' => 'public.order-tracking.bottom'])
@endsection

@section('scripts')
    <script>
        $('#search-order').on('click', function () {
            let trackingNumber = $('#trackingNumber');
            let url = $(this).data('url') + '?t=' + trackingNumber.val().replace(/#/, '');

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
