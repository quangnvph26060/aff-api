<?php

namespace App\Listeners;

use App\Events\EventOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Log;

class SendMailOrder implements ShouldQueue
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
     * @param  \App\Events\EventOrder  $event
     * @return void
     */
    public function handle(EventOrder $event)
    {
        $user = $event->user;
        $order = $event->order;
        $this->mailer->send('emails.order', ['user' => $user, 'order' => $order], function ($message) use ($user) {
            $message->to($user['email'])
                ->subject('Đơn hàng của bạn đã được đặt thành công');
        });
    }
}
