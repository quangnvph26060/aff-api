<?php

namespace App\Listeners;

use App\Events\EventForgetPass;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Summary of SendMailForgetPass
 */
class SendMailForgetPass
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $mailer;
    /**
     * Summary of __construct
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventForgetPass  $event
     * @return void
     */
    public function handle(EventForgetPass $event)
    {
        $user = $event->user;
        $newPassword = $event->newPassword;
        $this->mailer->send('emails.forgetpass', ['user' => $user, 'newPassword' => $newPassword], function ($message) use ($user) {
            $message->to($user['email'])
                ->subject('Mật khẩu mới của bạn là gì');
        });
    }
}
