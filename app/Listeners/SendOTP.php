<?php

namespace App\Listeners;

use App\Events\EventSendOTP;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Mail\Mailer;

class SendOTP
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    /**
     * Handle the event.
     *
     * @param  \App\Events\EventSendOTP  $event
     * @return void
     */
    public function handle(EventSendOTP $event)
    {
        $otp = $event->otp;
        $email = $event->email;
        $this->mailer->send('emails.otp', ['otp' => $otp], function ($message) use ($email) {
            $message->to($email)
                ->subject('Your OTP Code');
        });
    }
}
