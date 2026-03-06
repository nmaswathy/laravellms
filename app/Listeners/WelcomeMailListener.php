<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;

class WelcomeMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
       Mail::to($event->user['email'])->send(new UserCreatedMail($event->user));
        Mail::to('cpoaswathy@gmail.com')->send(new UserCreatedMail($event->user));
    }
}
