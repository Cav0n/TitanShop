@php
    $cart = session()->get('cart');
@endphp

@extends('default.templates.public')

@section('page.title', 'Mon panier')

@section('page.content')
    <h2>
        Mon panier
    </h2>

    @include('default.components.cart-steps')

    <div id="cart-container" class="row mx-0 mb-3">
        @if (0 !== count($cart->items))
        <div id="items-container" class="col-lg-8 p-3">
            <h3>Produits</h3>

            <table class="table table-bordered mb-0 bg-white">
                <tbody>
                    @foreach ($cart->items as $item)
                    <tr class="cart-item">
                        <td>{{$item->product->i18nValue('title')}}</td>
                        <td class="text-center item-quantity-container">
                            <input class="item-quantity" type="number" min="0" max="{{$item->product->stock}}" value="{{$item->quantity}}" data-id="{{$item->id}}" data-price="{{$item->price}}">
                        </td>
                        <td class="text-right">{{$item->priceFormatted}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group mt-3 mb-0">
                <label for="customer-message">Message pour votre commande</label>
                <textarea class="form-control" name="customer-message" id="customer-message" aria-describedby="helpCustomerMessage" rows=4>{{$cart->customerMessage}}</textarea>
                <small id="helpCustomerMessage" class="form-text text-muted">Vous pouvez indiquez des précisions pour votre commande ici.</small>
            </div>
        </div>
        <div id='summary' class="col-lg-4 p-3">
            <h3>Résumé</h3>

            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-left">{{$cart->totalQuantity}} produits :</td>
                        <td class="text-right cart-items-price">{{$cart->itemsPriceFormatted}}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Frais de port :</td>
                        <td class="text-right cart-shipping-price">{{$cart->shippingPriceFormatted}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><b>Total :</b></td>
                        <td class="text-right cart-total-price"><b>{{$cart->totalPriceFormatted}}</b></td>
                    </tr>
                </tbody>
            </table>

            <a class="btn btn-primary w-100 shadow-none border-0" href="{{route('cart.delivery')}}" role="button" id="next-step-button">Passer à la livraison</a>
        </div>
        @else
            <div class="col-lg-6">
                <img src="{{asset('images/utils/empty-cart.svg')}}" alt="404">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h3>Votre panier est vide...</h3>
                <a class="btn btn-primary text-white" style="width: fit-content" href="{{route('homepage')}}">
                    Ajouter des produits à mon panier</a>
            </div>
        @endif
    </div>
@endsection

@section('page.scripts')
    <script>
        let quantityInputs = $('.item-quantity');

        quantityInputs.on('change', function () {
            $(this).attr('disabled', 'disabled');
            updateItemQuantity($(this).data('id'), $(this).val());
        });

        $(document).on('itemQuantityUpdated', function (event, data) {
            $('.cart-items-price').text(data.prices.items);
            $('.cart-shipping-price').text(data.prices.shipping);
            $('.cart-total-price').html('<b>' + data.prices.total + '</b>');

            $('#items-container').find('.item-quantity[data-id='+data.itemId+']').removeAttr('disabled');
        });

        function updateItemQuantity(itemId, quantity = 1) {
            $.ajax({
                url : "{{route('cart.items.quantity.update')}}",
                type : 'POST',
                dataType : 'json',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    id: itemId,
                    quantity: quantity
                },
                success : function(data, status){
                    if (1 === $('.cart-item').length && 0 === parseInt(quantity)) {
                        location.reload();
                    }

                    $(document).trigger('itemQuantityUpdated', {itemId: itemId, prices: data.prices});
                },
                error : function(data, status, error){
                    console.error('Item quantity can\'t be updated : ' + error);
                }
            });
        }
    </script>

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
                    console.error('Customer message can\'t be updated : ' + error);
                }
            });
        }
    </script>
@endsection
