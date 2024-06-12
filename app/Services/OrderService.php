<?php

namespace App\Services;

use App\Http\Responses\ApiResponse;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderService{
    protected $order, $orderDetail;

    public function __construct(Order $order, OrderDetail $orderDetail)
    {
        $this -> order = $order;
        $this -> orderDetail = $orderDetail;
    }

    public function createOrder($data)
    {
        DB::beginTransaction();
        try{
            Log::info('Create new order');
            $user_id = Auth::user()->id;
            $receive_address = $data['receive_address'];
            $note = $data['note'];
            $total_money = $data['total'];
            $order = $this->order->create([
                'user_id' => $user_id,
                'receive_address' => $receive_address,
                'note' => $note,
                'total_money' => $total_money,
                'status' => 'pending',
            ]);
            foreach ($data['order_details'] as $detail) {
                $order->orderDetails()->create([
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['quantity'],
                ]);
            }
            DB::commit();
            return $order;
        }
        catch(Exception $e){
            DB::rollBack();
            Log::error('Failed to create new order: '.$e->getMessage());
            throw new Exception('Failed to create new order');
        }


    }
}
