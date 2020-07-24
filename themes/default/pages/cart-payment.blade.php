@php
    $cart = session()->get('cart');
@endphp

@extends('default.templates.public')

@section('page.title', 'Mon panier - Paiement')

@section('page.content')
    <h2>
        Mon panier - Paiement
    </h2>

    @include('default.components.cart-steps')

    @include('default.components.error')

    <div id="cart-container" class="row mx-0 mb-3">
        <form id="payment-form" class="col-lg-8 p-3" action="{{route('cart.payment')}}" method="POST">
            @csrf

            <div class="row">
                <div class="col-lg-12">
                    <h3>Informations personnelles</h3>
                </div>

                <div class="form-group col-lg-8">
                    <label for="email">Votre email *</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="helpEmail">
                    <small id="helpEmail" class="form-text text-muted">Vous recevrez les notifications de suivi de commande à cette adresse email.</small>
                </div>

                <div class="form-group col-lg-4">
                    <label for="phone">Votre numéro de téléphone</label>
                    <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpPhone">
                    <small id="helpPhone" class="form-text text-muted">Vous pouvez indiquez votre numéro de téléphone pour être contacter plus rapidement à propos de votre commande.</small>
                </div>

                <div class="col-lg-12">
                    <h3>Paiement</h3>
                </div>

                <div class="col-lg-12">
                    <label class="btn btn-primary @if(old('payment', null) === 'cheque') checked @else disabled @endif">
                        <input type="radio" class="payment-radio-selection" name="payment" id="cheque" autocomplete="off" value="cheque" @if(old('payment', null) === 'cheque') checked @else disabled="disabled" @endif>
                            Chèque
                    </label>
                    <label class="btn btn-primary @if(old('payment', null) === 'card') active @else disabled @endif">
                        <input type="radio" class="payment-radio-selection" name="payment" id="card" autocomplete="off" value="card" @if(old('payment', null) === 'card') checked @else disabled="disabled" @endif>
                            Carte bancaire
                    </label>
                    <label class="btn btn-primary @if(old('payment', null) === 'paypal') checked @else disabled @endif">
                        <input type="radio" class="payment-radio-selection" name="payment" id="paypal" autocomplete="off" value="paypal" @if(old('payment', null) === 'paypal') checked @else disabled="disabled"@endif>
                            Paypal
                    </label>
                </div>
            </div>

            <div class="form-group mt-3 mb-0 pt-3 border-top border-dark">
                <label for="customer-message">Message pour votre commande</label>
                <textarea class="form-control" name="customer-message" id="customer-message" aria-describedby="helpCustomerMessage" rows=4>{{$cart->customerMessage}}</textarea>
                <small id="helpCustomerMessage" class="form-text text-muted">Vous pouvez indiquez des précisions pour votre commande ici.</small>
            </div>
        </form>
        <div id='summary' class="col-lg-4 p-3">
            <h3>Résumé</h3>

            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-left">{{$cart->totalQuantity}} produits :</td>
                        <td class="text-right">{{$cart->itemsPriceFormatted}}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Frais de port :</td>
                        <td class="text-right">{{$cart->shippingPriceFormatted}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><b>Total :</b></td>
                        <td class="text-right"><b>{{$cart->totalPriceFormatted}}</b></td>
                    </tr>
                </tbody>
            </table>

            <button id="next-step-button" type="submit" class="btn btn-primary w-100 shadow-none border-0" form="payment-form">
                Payer</button>
        </div>
    </div>
@endsection

@section('page.scripts')
    <script>
        let customerMessageInput = $('#customer-message');
        let nextStepButton = $('#next-step-button');

        $(document).on('messageAddedToCart', function () {
            customerMessageInput.removeAttr('disabled');
            nextStepButton.removeAttr('disabled').removeClass('disabled');
        });

        customerMessageInput.on('change', function () {
            customerMessageInput.attr('disabled', 'disabled');
            nextStepButton.attr('disabled', 'disabled').addClass('disabled');

            addCustomerMessageToCart($(this).val());
        });

        async function addCustomerMessageToCart(message)
        {
            $.ajax({
                url : "{{route('cart.customer-message.add')}}",
                type : 'POST',
                dataType : 'json',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    message: message
                },
                success : function(data, status){
                    $(document).trigger('messageAddedToCart');
                },
                error : function(data, status, error){
                    console.error('Visibility can\'t be updatedss : ' + error);
                }
            });
        }
    </script>

    <script>
        let paymentRadioSelection = $('.payment-radio-selection');
        let emailInput = $('#email');

        paymentRadioSelection.on('click', function () {
            paymentRadioSelection.parent().removeClass('active');
            $(this).parent().addClass('active');

            if (paymentIsSelected()) {
                $('#next-step-button').removeAttr('disabled');
            } else {
                $('#next-step-button').attr('disabled', 'disabled');
            }
        });

        emailInput.on('input', function () {
            if (!$.trim(this.value).length || !isValidEmailAddress(this.value)) {
                paymentRadioSelection.parent().removeClass('active').addClass('disabled');
                paymentRadioSelection.attr('disabled', 'disabled');
            } else {
                paymentRadioSelection.parent().removeClass('disabled');
                paymentRadioSelection.removeAttr('disabled');
            }
        });

        function paymentIsSelected() {
            return $("input[name='payment']:checked").val();
        }

        function isValidEmailAddress(emailAddress) {
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            return pattern.test(emailAddress);
        }

        $(document).ready(function () {
            if (! paymentIsSelected()) {
                $('#next-step-button').attr('disabled', 'disabled');
            }
        });

        $(document).on('messageAddedToCart', function () {
            console.log(paymentIsSelected() && isValidEmailAddress($('#email').val()));
            if (paymentIsSelected() && isValidEmailAddress($('#email').val())) {
                $('#next-step-button').removeAttr('disabled');
            } else {
                $('#next-step-button').attr('disabled', 'disabled');
            }
        });
    </script>
@endsection
