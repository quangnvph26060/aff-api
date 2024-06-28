<?php
namespace App\Jobs;


use App\Events\EventForgetPass;

use App\Events\EventOrder;

use App\Events\EventRegister;
use App\Events\EventSendMailBrand;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = $this->request;
        if ($data['type'] && $data['type'] == 'send_otp') {
            
            event(new EventRegister($data['user'], $data['otp']));

        } else  if ($data['type'] && $data['type'] == 'send_order') {

            event(new EventOrder($data['user'], $data['order']));

        }else if   ($data['type'] && $data['type'] == 'password_new'){

            event(new EventForgetPass($data['user'], $data['newPassWord']));

        }else if ($data['type'] && $data['type'] === 'send_brands'){

            event(new EventSendMailBrand($data['email'], $data['order']));
        }
    }
}
