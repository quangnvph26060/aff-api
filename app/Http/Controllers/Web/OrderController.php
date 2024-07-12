<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\OrderNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * hàm lấy ra thông tin order
     */
    public function index(Request $request)
    {
        try {
            $orders = $this->orderService->getAllOrder($type = 'web');
            $title = 'Danh sách đơn hàng';
            if ($request->session()->has('authUser')) {
                $result = $request->session()->get('authUser');
                $role  = $result['user']['role_id'];
               
            }
            return view('admin.order.list', compact('orders','title','role'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch orders: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch orders', 500);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $orderStatus = $this->orderService->updateStatus($request->all());
            return ApiResponse::success($orderStatus, 'success', 200);
        } catch (\Exception $e) {
            Log::error('Failed to change  order status: ' . $e->getMessage());
            return ApiResponse::error('Failed to change  order status', 500);
        }
    }
}
