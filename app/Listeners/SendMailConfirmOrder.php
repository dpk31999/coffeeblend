<?php

namespace App\Listeners;

use App\Events\CustomerOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\Mail\SubmitOrderMail;

class SendMailConfirmOrder implements ShouldQueue
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
     * @param  CustomerOrder  $event
     * @return void
     */
    public function handle(CustomerOrder $event)
    {
        Mail::to($event->invoice->customer->email)
        ->send(new SubmitOrderMail($event->invoice));
    }
}
