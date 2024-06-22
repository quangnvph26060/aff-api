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
            
            $order = $this->order->where('notify', 0)->count();
           
            if (!$order) {
                throw new OrderNotFoundException();
            }
            $view->with('orderCount',$order);
        } else {
            $view->with('orderCount', null);
        }
    }
}

?>