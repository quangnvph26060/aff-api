<?php

namespace App\Http\View\Composers;

use App\Exceptions\OrderNotFoundException;
use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class OrderComposer
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function compose(View $view)
    {

        $request = Request::instance();
        if ($request->session()->has('authUser')) {

            $orderCount = $this->order->where('notify', 0)->count();

            if (!$orderCount) {
                throw new OrderNotFoundException();
            }
            $dataOrder = $this->order->where('notify', 0)->get();

            // Gán dữ liệu cho view
            $view->with([
                'orderCount' => $orderCount,
                'dataOrder' => $dataOrder,
            ]);
        } else {
          
            $view->with([
                'orderCount' => null,
                'dataOrder' => [],
            ]);
        }
    }
}
