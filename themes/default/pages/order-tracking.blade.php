@extends('default.templates.public')

@section('page.title', 'Suivi de commande')

@section('page.content')
    @include('default.components.breadcrumb', ['breadcrumb' => [['link' => route('homepage'), 'title' => 'Accueil'], ['link' => route('order.tracking'), 'title' => 'Suivi de commande']] ])

    <div class="row">
        <div class="col-lg-6">
            <h2>Suivi de commande</h2>
        </div>
    </div>

    <div class="row mb-3">
        <div class="form-group col-lg-6">
            <label for="tracking_number">Numéro de suivi</label>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">#</span>
                </div>
                <input type="text" class="form-control" name="tracking_number" id="tracking_number">
            </div>

            <div class="form-group">
                <label for="tracking_email">Email</label>
                <input type="email" class="form-control" name="tracking_email" id="tracking_email" aria-describedby="helpEmail">
                <small id="helpEmail" class="form-text text-muted">Email précisé lors du passage de la commande</small>
            </div>

            <button id="track-btn" type="button" class="btn btn-primary">Obtenir le suivi</button>
        </div>

        <div id="order-tracking-content" class="col-lg-6 bg-light shadow-sm p-3 text-center d-flex flex-column justify-content-center">
            <p>Vous retrouverez ici les informations sur votre commande.</p>
        </div>
    </div>
@endsection

@section('page.scripts')
    <script>
        let actualTrackingNumber = '';
        let actualEmail = '';

        $('#track-btn').on('click', function () {
            let trackingNumber = $('#tracking_number').val();
            let email = $('#tracking_email').val()
            track(trackingNumber, email);
        });

        function track(trackingNumber, email) {
            if (stringIsEmpty(trackingNumber)) {
                console.error('Tracking number is not defined.');
                return;
            }

            if (trackingNumber === actualTrackingNumber && email === actualEmail) {
                console.error('Tracking number already submitted.');
                return;
            }

            actualTrackingNumber = trackingNumber;
            actualEmail = email;
            console.log(trackingNumber);

            $.ajax({
                url : "{{ route('order.tracking') }}",
                type : 'POST',
                dataType : 'json',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    trackingNumber: trackingNumber,
                    email:          email
                },
                beforeSend : function(xhr) {
                    $('#track-btn').attr('disabled', 'disabled');
                    $('#tracking_number').attr('disabled', 'disabled');
                    $('#tracking_email').attr('disabled', 'disabled');
                },
                success : function(data, status){
                    $('#track-btn').removeAttr('disabled');
                    $('#tracking_number').removeAttr('disabled');
                    $('#tracking_email').removeAttr('disabled')
                    showTrackingResult(data.order);
                },
                error : function(data, status, error){
                    $('#track-btn').removeAttr('disabled');
                    $('#tracking_number').removeAttr('disabled');
                    $('#tracking_email').removeAttr('disabled')
                    showErrorResult();
                }
            });
        }

        function showTrackingResult(order) {
            $('#order-tracking-content').html(`
                <p>Commande passée le ` + order.date + `</p>
                <p>Statut actuel de la commande : ` + order.status + `</p>
            `);
        }

        function showErrorResult() {
            $('#order-tracking-content').html(`
                <p>Aucune commande n'a été trouvée avec ce numéro de suivi.</p>
            `);
        }

        function stringIsEmpty(str) {
            return !str || 0 === str.length || !str.trim();
        }
    </script>
@endsection
