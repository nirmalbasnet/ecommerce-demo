<?php

namespace App\Listeners;

use App\Events\NewsletterSubscribed;
use App\Mail\NewsLetterSubscriber;
use App\Model\Newsletter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNewsletterSubscribedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewsletterSubscribed  $event
     * @return void
     */
    public function handle(NewsletterSubscribed $event)
    {
        $subscriber = $event->newsLetter;
        if(Newsletter::find($subscriber->id)->verified == 'no')
        {
            Mail::to($subscriber->email)->send(new NewsLetterSubscriber($subscriber->email));
        }
    }
}
