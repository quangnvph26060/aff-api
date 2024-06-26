<?php

namespace App\Services;

use App\Enums\RequestApi;
use App\Events\NewOrderEvent;
use App\Exceptions\OrderNotFoundException;
use App\Http\Responses\ApiResponse;
use App\Jobs\SendEmailJob;
use App\Jobs\SendMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserWallet;

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
            $user = Auth::user();
            $user_id = $user->id;
            $receive_address = $data['receive_address'];
            $total_money = $data['total_money'];
            $this->getUserTeam($total_money);
            $order = $this->order->create([
                'user_id' => $user_id,
                'receive_address' => $receive_address,
                'note' => null,
                'total_money' => $total_money,
                'status' => 1,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'zip_code' => $data['zip_code'],
                'notify' => 0,
            ]);
            if (!$order) {
                return response()->json('error', 'Order error');
            }
            $arrMail = []; // mail
            foreach ($data['list_product'] as $detail) {
                $this->orderDetail->create([
                    'order_id' => $order->id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['amount'],
                ]);
                
                $email = $detail['product']['brands']['email'];
                if (!in_array($email, $arrMail)) {
                    $arrMail[] = $email;
                }

                $product = Product::where('id', $detail['product_id'])->first();
                $product->quantity = $product->quantity - $detail['amount'];
                $product->save();
            }
            
            foreach ($arrMail as $email) {
                $arrSendMail = [
                    'type' => 'send_brands',
                    'email' => $email,
                    'order' => $order->orderDetail,
                ];
                SendMail::dispatch($arrSendMail); // send email to  brand
            }
            $arrSendMail = [
                'type' => 'send_order',
                'user' => $user,
                'order' => $order->orderDetail,
            ];
            SendMail::dispatch($arrSendMail); // send email to  user order
            event(new NewOrderEvent()); // notify to admin

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create new order: ' . $e->getMessage());
            throw new Exception('Failed to create new order');
        }
    }

    /**
     * hàm lấy ra user trong team
     */
    // public function getUserTeam($total_money)
    // {
    //     $user = Auth::user();
    //     $referr1 = $user->referrer_id;
    //     if ($referr1) {
    //         $referr2 = User::where('referral_code', $referr1)->first();
    //         $result =  UserWallet::where('user_id', $referr2->id)->where('wallet_id', 2)->first();
    //         $result->update([
    //             'total_revenue' => $result->total_revenue + ($total_money * 0.25),
    //         ]);
    //         if ($referr2) {
    //             $referr3 = User::where('referral_code', $referr2->referrer_id)->first();
    //             $result =  UserWallet::where('user_id', $referr3->id)->where('wallet_id', 2)->first();
    //             if(!$result){
    //                 return false;
    //             }
    //             $result->update([
    //                 'total_revenue' => $result->total_revenue + ($total_money * 0.10),
    //             ]);
    //             if ($referr3) {
    //                 $referr4 = User::where('referral_code', $referr3->referrer_id)->first();
    //                 $result =  UserWallet::where('user_id', $referr4->id)->where('wallet_id', 2)->first();
    //                 if(!$result){
    //                     return false;
    //                 }
    //                 $result->update([
    //                     'total_revenue' => $result->total_revenue + ($total_money * 0.07),
    //                 ]);
    //                 if ($referr4) {
    //                     $referr5 = User::where('referral_code', $referr4->referrer_id)->first();
    //                     $result =  UserWallet::where('user_id', $referr5->id)->where('wallet_id', 2)->first();
    //                     if(!$result){
    //                         return false;
    //                     }
    //                     $result->update([
    //                         'total_revenue' => $result->total_revenue + ($total_money * 0.05),
    //                     ]);
    //                     if ($referr5) {
    //                         $referr6 = User::where('referral_code', $referr5->referrer_id)->first();
    //                         $result =  UserWallet::where('user_id', $referr6->id)->where('wallet_id', 2)->first();
    //                         if(!$result){
    //                             return false;
    //                         }
    //                         $result->update([
    //                             'total_revenue' => $result->total_revenue + ($total_money * 0.03),
    //                         ]);
    //                     }

    //                 }

    //             }
    //         }
    //     }
    //     return true;
    // }
    public function getUserTeam($total_money)
    {
        $user = Auth::user();
        $currentReferrerId = $user->referrer_id;

        $percentages = [0.25, 0.10, 0.07, 0.05, 0.03]; // Các phần trăm tương ứng cho F1 đến F5

        for ($i = 0; $i < 5 && $currentReferrerId; $i++) {
            $referrer = User::where('referral_code', $currentReferrerId)->first();
            if ($referrer) {
                $result = UserWallet::where('user_id', $referrer->id)->where('wallet_id', 2)->first();
                if ($result) {
                    $result->update([
                        'total_revenue' => $result->total_revenue + ($total_money * $percentages[$i])
                    ]);
                } else {
                    // Dừng vòng lặp nếu không tìm thấy UserWallet
                    break;
                }
                $currentReferrerId = $referrer->referrer_id;
            } else {
                break;
            }
        }

        return true;
    }


    public function getOrderAmount()
    {
        try {
            $number = $this->order->count();
            $total = $this->order->sum('total_money');
            $result = new \Illuminate\Database\Eloquent\Collection;
            $result->push((object)[
                'number' => $number,
                'total' => $total,
            ]);
            return $result;
        } catch (\Exception $e) {
            Log::error('Failed to count order: ' . $e->getMessage());
            throw new Exception('Failed to count orders');
        }
    }
    public function getBestSeller()
    {
        try {

            $bestseller = $this->orderDetail
                ->select(
                    'products.name as product_name',
                    'categories.name as category_name',
                    DB::raw('SUM(order_details.quantity *products.price) as total_cost'),
                    DB::raw('Sum(order_details.quantity) as total_sold_amount')
                )
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->groupBy('products.id', 'products.name', 'categories.name')
                ->orderBy('total_sold_amount', 'desc')
                ->limit(6)
                ->get();
            // dd($bestseller);
            return $bestseller;
        } catch (\Exception $e) {
            Log::error('Failed to retrieve orders: ' . $e->getMessage());
            throw new Exception('Failed to retrieve orders');
        }
        // dd($result);
    }
    public function getAllOrder($type)
    {
        try {
            if ($type == RequestApi::API) {
                $user_id = Auth::user()->id;
                $orders = $this->order->where('user_id', $user_id)->get();
                $orderCount = $this->order->where('user_id', $user_id)->where('status', 3)->count();
                $data = [
                    'orders' => $orders,
                    'orderCount' => $orderCount,
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


    public function orderNew()
    {
        try {

            $order = $this->order->orderBy('created_at', 'desc')->take(5)->get();
            return $order;
        } catch (\Exception $e) {
            Log::error('Lỗi không lấy ra đơn hàng: ' . $e->getMessage());
            throw new Exception('Lỗi không lấy ra đơn hàng');
        }
    }
    public function updateNotify($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->order->where('id', $id)->first();
            $order->update([
                'notify' => 1,
            ]);
            DB::commit();
            return $order;
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            $exception = new OrderNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR: ' . $e->getMessage());
            throw new Exception('ERROR');
        }
    }

    public function getMonthlyRevenue()
    {
        $currentYear = date('Y');

        $monthlyRevenue = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_money) as total')
        )
        ->whereYear('created_at', $currentYear)
        ->groupBy('year', 'month')
        ->orderBy('month')
        ->get()
        ->keyBy('month');

        $months = range(1, 12);
        $monthlyRevenueWithZeroes = [];
        foreach ($months as $month) {
            $monthlyRevenueWithZeroes[$month] = isset($monthlyRevenue[$month]) ? $monthlyRevenue[$month]->total : 0;
        }
        $totalAnnualRevenue = array_sum($monthlyRevenueWithZeroes);

        return [
            'monthlyRevenue' => array_values($monthlyRevenueWithZeroes),
            'totalAnnualRevenue' => $totalAnnualRevenue,
        ];
    }
}
