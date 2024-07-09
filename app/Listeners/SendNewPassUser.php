<?php

namespace App\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use App\Events\EventSendNewPassUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewPassUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventSendNewPassUser  $event
     * @return void
     */
    public function handle(EventSendNewPassUser $event)
    {
        $user = $event->user;
        $this->mailer->send('emails.setnewpassuser', ['user' => $user], function ($message) use ($user) {
            $message->to($user['email'])
                ->subject('Mật khẩu mới của bạn');
        });
    }
}
