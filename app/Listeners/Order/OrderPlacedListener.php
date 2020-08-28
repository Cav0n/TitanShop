<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPlacedEvent;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderPlacedListener
{
    private $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderPlacedEvent $event)
    {
        Cart::generateNewCartSession($this->request);
    }
}
