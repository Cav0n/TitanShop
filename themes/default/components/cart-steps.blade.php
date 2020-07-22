<nav class="cart-steps-container">
    <ol class="cart-steps-list">
        <li @if($cart->step === \App\Models\Cart::CART_STEP_HOME)
                class="active"
            @elseif($cart->step === \App\Models\Cart::CART_STEP_DELIVERY || $cart->step === \App\Models\Cart::CART_STEP_PAYMENT)
                class="past"
            @endif>
            Panier</li>
        <li @if($cart->step === \App\Models\Cart::CART_STEP_DELIVERY)
                class="active"
            @elseif($cart->step === \App\Models\Cart::CART_STEP_PAYMENT)
                class="past"
            @endif>
            Livraison</li>
        <li @if($cart->step === \App\Models\Cart::CART_STEP_PAYMENT) class="active" @endif>
            Paiement</li>
    </ol>
</nav>
