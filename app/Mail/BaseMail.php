<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BaseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Subject of the email
     *
     * @var mixed
     */
    public $subject;

    /**
     * Name of the shop
     *
     * @var mixed
     */
    public $shopName;

    /**
     * Email of the shop
     *
     * @var mixed
     */
    public $shopEmail;

    /**
     * URL of the shop
     *
     * @var mixed
     */
    public $shopUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subject = "Notification " . $this->shopName;
        $this->shopName = \App\Setting::valueOrNull('SHOP_NAME');
        $this->shopEmail = \App\Setting::valueOrNull('SHOP_EMAIL');
        $this->shopURL = \App\Setting::valueOrNull('SHOP_URL');
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
                    ->view('themes.default.emails.contact.message');
    }
}
