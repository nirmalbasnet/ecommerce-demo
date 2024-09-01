<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateAutoUser extends Mailable
{
    use Queueable, SerializesModels;
    protected $createdUser, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($createdUser, $password)
    {
        $this->createdUser = $createdUser;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email/create-auto-user')
            ->subject('You have been registered with kankai.com.')
            ->with('createdUser', $this->createdUser)
            ->with('password', $this->password);
    }
}
