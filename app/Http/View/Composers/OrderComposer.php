<?php

namespace App\Http\View\Composers;

use App\Exceptions\OrderNotFoundException;
use App\Models\Order;
use App\Models\OrderDetail;
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
            $result = $request->session()->get('authUser');
            $role  = $result['user']['role_id'];
            if($role === 1){
                $orderCount = $this->order->where('notify', 0)->count();
                if (!$orderCount) {
                    // throw new OrderNotFoundException();
                }
                $dataOrder = $this->order->where('notify', 0)->get();

                // Gán dữ liệu cho view
                $view->with([
                    'orderCount' => $orderCount,
                    'dataOrder' => $dataOrder,
                ]);
            } else if ($role === 4 ){
                $brandId = $result['user']['id'];
                $orderCount = $this->order->where('notify', 0)
                    ->whereHas('orderDetails', function ($query) use ($brandId) {
                        $query->join('products', 'order_details.product_id', '=', 'products.id')
                              ->where('products.brands_id', $brandId);
                    })
                    ->count();
                if (!$orderCount) {
                    // throw new OrderNotFoundException();
                }
                $dataOrder = $this->order->where('notify', 0)
                ->whereHas('orderDetails', function ($query) use ($brandId) {
                    $query->join('products', 'order_details.product_id', '=', 'products.id')
                          ->where('products.brands_id', $brandId);
                })
                ->get();
                 // Gán dữ liệu cho view
                 $view->with([
                    'orderCount' => $orderCount,
                    'dataOrder' => $dataOrder,
                ]);
            }
        } else {
          
            $view->with([
                'orderCount' => null,
                'dataOrder' => [],
            ]);
        }
    }
}
