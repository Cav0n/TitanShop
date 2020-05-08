<div class="order-minimal">
    <p>Commande effectuée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
    {!! $order->status->badge !!}
</div>
