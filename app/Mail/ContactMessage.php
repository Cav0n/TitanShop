<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends BaseMail
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
        parent::__construct();

        $this->customerMessage = $customerMessage;
        $this->customerEmailAddress = $customerEmailAddress;
        $this->customerName = $customerName;
        $this->subject = "Nouveau message d'un client";
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
