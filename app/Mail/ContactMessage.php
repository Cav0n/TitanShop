<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The customer name
     *
     * @var mixed
     */
    public $customerName;

    /**
     * The customer email address
     *
     * @var mixed
     */
    public $customerEmailAddress;

    /**
     * The customer message
     *
     * @var string
     */
    public $customerMessage;

    /**
     * Name of the shop
     *
     * @var string
     */
    public $shopName;

    /**
     * Subject of the email
     *
     * @var mixed
     */
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        string $customerName,
        string $customerEmailAddress,
        string $customerMessage
        )
    {
        $this->customerMessage = $customerMessage;
        $this->customerEmailAddress = $customerEmailAddress;
        $this->customerName = $customerName;
        $this->subject = "Nouveau message d'un client";

        $this->shopName = \App\Setting::valueOrNull('SHOP_NAME');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->from(\App\Setting::valueOrNull('SHOP_EMAIL'), \App\Setting::valueOrNull('SHOP_NAME'))
                    ->view('themes.default.emails.contact.message');
    }
}
