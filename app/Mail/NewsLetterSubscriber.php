<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsLetterSubscriber extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email/news-letter-subscriber')
            ->subject('Thank you for showing interest in Kankai.com newsletter. Please verify your subscription.')
            ->with(['email' => $this->email]);
    }
}
