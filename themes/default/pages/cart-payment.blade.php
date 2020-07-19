@php
    $cart = session()->get('cart');
@endphp

@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Mon panier - Paiement
    </h2>

    @include('default.components.error')

    <div id="cart-container" class="row mx-0 mb-3">
        <form id="payment-form" class="col-lg-8 p-3" action="{{route('cart.payment')}}" method="POST">
            @csrf

            <div class="row">
                <div class="col-lg-12">
                    <h3>Paiement</h3>
                </div>

                <div class="col-lg-12">
                        <label class="btn btn-primary @if(old('payment', null) === 'cheque') checked @endif">
                            <input type="radio" class="payment-radio-selection" name="payment" id="cheque" autocomplete="off" value="cheque" @if(old('payment', null) === 'cheque') checked @endif>
                                Chèque
                        </label>
                        <label class="btn btn-primary @if(old('payment', null) === 'card') active @endif">
                            <input type="radio" class="payment-radio-selection" name="payment" id="card" autocomplete="off" value="card" @if(old('payment', null) === 'card') checked @endif>
                                Carte bancaire
                        </label>
                        <label class="btn btn-primary @if(old('payment', null) === 'paypal') checked @endif">
                            <input type="radio" class="payment-radio-selection" name="payment" id="paypal" autocomplete="off" value="paypal" @if(old('payment', null) === 'paypal') checked @endif>
                                Paypal
                        </label>
                </div>
            </div>

            <div class="form-group mt-3 mb-0 pt-3 border-top border-dark">
                <label for="customer-message">Message pour votre commande</label>
                <textarea class="form-control" name="customer-message" id="customer-message" aria-describedby="helpCustomerMessage" rows=4></textarea>
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

            <button id="pay-button" type="submit" class="btn btn-primary w-100 shadow-none border-0" form="payment-form">
                Payer</button>
        </div>
    </div>
@endsection

@section('page.scripts')
    <script>
        let paymentRadioSelection = $('.payment-radio-selection');

        paymentRadioSelection.on('click', function () {
            paymentRadioSelection.parent().removeClass('active');
            $(this).parent().addClass('active');
            
            if (paymentIsSelected()) {
                $('#pay-button').removeAttr('disabled');
            } else {
                $('#pay-button').attr('disabled', 'disabled');
            }
        });

        function paymentIsSelected() {
            return $("input[name='payment']:checked").val();
        }

        $(document).ready(function () {
            if (! paymentIsSelected()) {
                $('#pay-button').attr('disabled', 'disabled');
            }
        });
    </script>
@endsection