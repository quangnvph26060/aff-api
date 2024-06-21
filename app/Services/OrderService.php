<?php

namespace App\Services;

use App\Enums\RequestApi;
use App\Http\Responses\ApiResponse;
use App\Jobs\SendMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $order, $orderDetail;

    public function __construct(Order $order, OrderDetail $orderDetail)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }

    public function createOrder($data)
    {
        DB::beginTransaction();
        try {
            Log::info('Create new order');
            $user = Auth::user();
            $user_id = $user->id;
            $receive_address = $data['receive_address'];
            $total_money = $data['total_money'];
            $order = $this->order->create([
                'user_id' => $user_id,
                'receive_address' => $receive_address,
                'note' => null,
                'total_money' => $total_money,
                'status' => 1,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'zip_code' => $data['zip_code'],
            ]);
            if (!$order) {
                return response()->json('error', 'Order error');
            }
            foreach ($data['list_product'] as $detail) {
                $this->orderDetail->create([
                    'order_id' => $order->id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['amount'],
                ]);
                $product = Product::where('id', $detail['product_id'])->first();
                $product->quantity = $product->quantity - $detail['amount'];
                $product->save();
              
            }
            $arrSendMail = [
                'type' => 'send_order',
                'user' => $user,
                'order' => $order->orderDetail,
            ];
            SendMail::dispatch($arrSendMail);
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create new order: ' . $e->getMessage());
            throw new Exception('Failed to create new order');
        }
    }
    public function getAllOrder($type)
    {
        try {
            if($type == RequestApi::API){
                $user_id = Auth::user()->id;
                $orders = $this->order->where('user_id',$user_id)->get();
                $orderCount = $this->order->where('user_id',$user_id)->where('status', 3)->count();
                $data = [
                    'orders' => $orders,
                    'orderCount' =>$orderCount,
                ];
                return $data;
            }
            $orders = $this->order->all();
            return $orders;
        } catch (\Exception $e) {
            Log::error('Failed to retrieve orders: ' . $e->getMessage());
            throw new Exception('Failed to retrieve orders');
        }
    }
    public function updateStatus($data)
    {
        Log::info($data);
        try {
            $orderStatus  = $this->order->find($data['order_id']);
            if ($orderStatus) {
                $orderStatus->status = $data['status'];
                $orderStatus->save();
                return $orderStatus;
            }
        } catch (\Exception $e) {
            Log::error('Failed to change  order status: ' . $e->getMessage());
            return ApiResponse::error('Failed to change  order status', 500);
        }
    }

    public function getOrderNew()
    {
        try {
            $user_id = Auth::user()->id;
            $order = $this->order->where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
            return $order;
        } catch (\Exception $e) {
            Log::error('Lỗi không lấy ra đơn hàng: ' . $e->getMessage());
            throw new Exception('Lỗi không lấy ra đơn hàng');
        }
    }

    // public function getOrderDetail($order_id)
    // {
    //     try {
    //        $orderDetail = $this->orderDetail->where('order_id', $order_id)->get();
    //         return $orderDetail;
    //     } catch (\Exception $e) {
    //         Log::error('Lỗi không lấy ra chi đơn hàng: ' . $e->getMessage());
    //         throw new Exception('Lỗi không lấy ra đơn hàng');
    //     }
    // }
}
