<?php

namespace App\Listeners;

use App\Events\EventRegisterBrand;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendRegisterBrand
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
     * @param  \App\Events\EventRegisterBrand  $event
     * @return void
     */
    public function handle(EventRegisterBrand $event)
    {
        $data = $event->data;
        $password_mail = $event->password_mail;
        $this->mailer->send('emails.register_brand', ['password_mail'=>$password_mail, 'data' => $data], function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Thông tin đăng nhập');
        });
    }
}
