<?php

namespace App\Listeners;

use App\Events\InquirySubmitted;
use App\Mail\InquiryAlertMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class InquiryAlertEmail
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
     * @param  InquirySubmitted  $event
     * @return void
     */
    public function handle(InquirySubmitted $event)
    {
        $inquiry = $event->inquiry;
        Mail::to('kankai.ecommerce@gmail.com')->send(new InquiryAlertMail($inquiry));
    }
}
