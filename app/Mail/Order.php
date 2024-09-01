<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Order extends Mailable
{
    use Queueable, SerializesModels;
    protected $orderData, $destination;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderData, $destination)
    {
        $this->orderData = $orderData;
        $this->destination = $destination;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->destination == 'user') {
            $subject = 'Thank you for ordering product from kankai.com. Here is your order detail';
        } else {
            $subject = 'A new order has been placed';
        }

        return $this->markdown('email/order')
            ->subject($subject)
            ->with('destination', $this->destination)
            ->with('orderData', $this->orderData);

    }
}
