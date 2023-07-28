<?php

namespace App\Providers;

use App\Providers\MessageNewEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ParcelasEventSubscriber
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
     * @param  MessageNewEvent  $event
     * @return void
     */
    public function handle(MessageNewEvent $event)
    {
        //
    }
}
