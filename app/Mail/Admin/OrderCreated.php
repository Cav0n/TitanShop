<?php

namespace App\Mail\Admin;

use App\Mail\BaseMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends BaseMail
{
    use Queueable, SerializesModels;

    /**
     * The newly created order
     *
     * @var \App\Order
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Order $order)
    {
        parent::__construct();

        $this->order = $order;
        $this->subject = "Nouvelle commande - " . $this->shopName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->from($this->shopEmail, $this->shopName)
                    ->view('themes.default.emails.admin.order-created');
    }
}
