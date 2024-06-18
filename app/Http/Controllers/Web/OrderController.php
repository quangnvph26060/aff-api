<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Order;
use App\Services\OrderService;
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
    public function index()
    {
        try {
            $orders = $this->orderService->getAllOrder();
            Log::info($orders);
            return view('admin.order.list', compact('orders'));
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
