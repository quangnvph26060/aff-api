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
            $total_money = $data['total_money'];
            $order = $this->order->create([
                'user_id' => $user_id,
                'receive_address' => $receive_address,
                'note' => null,
                'total_money' => $total_money,
                'status' => 'pending',
                'name' => $data['name'],
                'phone' => $data['phone'],
                'zip_code' =>$data['zip_code'],
            ]);
            if(!$order){
                return response()->json('error','Order error');
            }
            foreach ($data['list_product'] as $detail) {
                $this->orderDetail->create([
                    'order_id' => $order->id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['amount'],
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
