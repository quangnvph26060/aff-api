<?php

namespace App\Listeners;

use App\Events\EventSendMailBrand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Log;

class SendMailBrand
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
     * @param  \App\Events\EventSendMailBrand  $event
     * @return void
     */
    public function handle(EventSendMailBrand $event)
    {
        $mail = $event->mail;
        $data = $event->data;
        Log::info($data);
        $this->mailer->send('emails.send-mail-brand', ['mail' => $mail, 'order' => $data], function ($message) use ($mail) {
            $message->to($mail)
                ->subject('Bạn có đơn hàng mới!');
        });
    }
}
