<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use App\Enums\RequestApi;
use App\Events\NewOrderEvent;
use App\Exceptions\OrderNotFoundException;
use App\Http\Responses\ApiResponse;
use App\Jobs\SendEmailJob;
use Faker\Generator as Faker;
use App\Jobs\SendMail;
use App\Models\AffSetting;
use App\Models\Commission;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserPackage;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Mail\Mailer;
class OrderService
{
    protected $order, $orderDetail;
    protected $faker;
    protected $mailer;
    public function __construct(Order $order, OrderDetail $orderDetail, Faker $faker,Mailer $mailer)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->faker = $faker;
        $this->mailer = $mailer;
    }
    protected function randomReferalCode()
    {
        $rand =  "RI" . $this->faker->numberBetween(10000000, 99999999);

        $exist_user = User::where('referral_code', $rand)->exists();
        while ($exist_user) {
            $this->randomReferalCode();
        }

        return $rand;
    }
    public function createOrder($data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $affSetting  = AffSetting::first();
            $user_id = $user->id;
            // Kiểm tra nếu user đã có referral_code rồi thì không cập nhật nữa
            if (!$user->referral_code) {
                // Tạo một mã referral code mới
                $newReferralCode = $this->randomReferalCode();
                $existingUser = User::where('referral_code', $newReferralCode)->first();

                if ($existingUser) {
                    do {
                        $newReferralCode = $this->randomReferalCode();
                        $existingUser = User::where('referral_code', $newReferralCode)->first();
                    } while ($existingUser);
                }

                $updateReferralCode = User::where('id', $user_id)->update(['referral_code' => $newReferralCode]);

                if (!$updateReferralCode) {
                    return response()->json(['status' => "error", 'message' => 'Error randomizing referral code']);
                }
            }

            $receive_address = $data['receive_address'];
            $total_money = $data['total_money'];
            if( $affSetting->status === "enabled" || $affSetting->status === "custom" ){
                $this->getUserTeam($total_money); // phần trăm hoa hồng cho từng tầng
            }
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
                'payment_method'=>$data['payment_method']
            ]);
            if (!$order) {
                return response()->json('error', 'Order product error');
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

            // Lấy access_token từ cache hoặc làm mới nếu hết hạn
           // $accessToken = $this->getAccessToken();
           
            // Log::info('accessToken new: ' . $accessToken);
            // try {
            //     $client = new Client();
            //     $response = $client->post('https://business.openapi.zalo.me/message/template',[
            //         'headers' => [
            //             'access_token' => 'T9nu7kDXZN1ucdOMus2BS76UTXRaU8if384E1keDzWaFzcKrcG_D0bghK2QXKUP1Llnj9PPSumO7scOrxMMOAItTEHRfJQyaSxmsF-OTW0G5XteRtJldDmkS6INg4f57AeWdHErjWraspm1zy76x7mFqEm7oIgO6PyGW09Ljs3i7baqNnnBvT3At1cxI3ADMDgjUCim8qo9Sy5S1d7QeObFQ2NV9TQ1v7jKgNDihWsGhZXe1mWIQ0X2A5ot82EaP9Qz02y1AkH5QoIOzkag61dBxVcQS7kXnLOmTQOKDdNTobJDtW0cnLMsEIs29Ciz668apPTG9j5mph18pm0YP7pgl02MkCvCRMw871R86gGDAlpmPhIEX1KQ51Mh9Ulj5FEHrPFaTuruGv4LRwsBALmJ8G4XjGwB8p5RYUePxs', // Thay YOUR_ACCESS_TOKEN bằng access token của bạn
            //             'Content-Type' => 'application/json'
            //         ],
            //         'json' => [
            //             'phone' => preg_replace('/^0/', '84',$order->user_id[0]['phone']), // Số điện thoại của người nhận
            //             'template_id' => '354647', // ID template của ZNS
            //             'template_data' => [
            //                 'order_code' => $order->zip_code ?? "",
            //                 'date' => Carbon::now()->format('d/m/Y') ?? "",
            //                 'price' => $order->total_money ?? "",
            //                 'name' => $order->user_id[0]['name'] ?? "Full Name",
            //                 'payment' => $order->payment_method === 1 ? " chuyển khoản" : " nhận hàng"
            //             ]
            //         ]
            //     ]);
            //     $responseBody = $response->getBody()->getContents();
            //     Log::info('Phản hồi API: ' . $responseBody);
            //     // Kiểm tra phản hồi từ API
            //     if ($response->getStatusCode() == 200) {
            //         Log::info('Gửi ZNS thành công.');
            //     } else {
            //         Log::error('Gửi ZNS thất bại: ' . $response->getBody());
            //     }
            // } catch (\Exception $e) {
            //     Log::error('Lỗi khi gửi ZNS: ' . $e->getMessage());
            // }
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create new order: ' . $e->getMessage());
            throw new Exception('Failed to create new order');
        }
    }
    public function refreshAccessToken($refreshToken, $secretKey, $appId)
    {
        $client = new Client();
        try {
            $response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
                'headers' => [
                    'secret_key' => $secretKey
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'app_id' => $appId
                ]
            ]);
    
            $body = json_decode($response->getBody(), true);
          
            if (isset($body['access_token'])) {
                // Lưu access_token mới vào cache
                Cache::put('access_token', $body['access_token'], 86400); // 86400 = 24h
                if (isset($body['refresh_token'])) {
                    // Lưu refresh_token mới vào cache nếu có
                    Cache::put('refresh_token', $body['refresh_token'],7776000); // 7776000 = 3 month
                }
                return $body['access_token'];
            } else {
                throw new \Exception('Failed to refresh access token');
            }
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            Log::error('Failed to refresh access token: ' . $e->getMessage());
            throw new \Exception('Failed to refresh access token');
        }
    }
    public function getAccessToken()
    {
        // Lấy access_token và refresh_token từ cache
        $accessToken = Cache::get('access_token');
        $is_refreshToken = Cache::get('refresh_token');
        Log::info('is_refreshToken: '.$is_refreshToken);
        // Nếu không có access_token trong cache, làm mới nó
        if (!$accessToken) {
            $refreshToken = '1eqITcWAwbKAYnn-Q0liLGEF77vl4-mmMk9WHKq2-p0kW4X967h0PswdJp1UVTjiKU9MDJDfqsyyZ54NDrtpRoJUH1KIFCfj1DzPFXacq1O5-YP2F1BICYEDLMSP3Vut4SfWM2CobtHLw0GbPYxtSrEbO3nXUV5r3e9X7s1srqvmfMu2JI3WGINSOoaAFfTgPSLaI0iruIeJpMnL337t5WVHKNnf9AGhNTfJGbCIsmvjqaj_JmR33boCK7P-QE8U7B1qP2un_p42jGuV5sYUJn-MRIC3QEe00AfcTZLsrYSRjtrC3b7x4JQ4NdW0GjGW0ebuQdH3oIP1k2L8HIUIDLp471jMHQSuMv89SMPdXL9xiIuMOMgROWwhEHmsD81W5zCCCXmK-6GGrseGE0lkN5komHjf4U5U';
            $secretKey = 'ZFIg89WL81V2R2Sj3vMd';
            $appId = '2355989370921006107';
            $accessToken = $this->refreshAccessToken($refreshToken, $secretKey, $appId);
        }
        return $accessToken;
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

        $rates = Commission::orderBy('rate', 'asc')
        ->get(['id', 'rate', 'status']) 
        ->mapWithKeys(fn($item) => [$item->id => $item->status == 1 ? $item->rate / 100 : 0])
        ->toArray();
        $reversedRates = array_reverse($rates);
        Log::info('Processed rates with keys:', $rates);

       // Các phần trăm tương ứng cho F1 đến F5
        for ($i = 1; $i <= 5 && $currentReferrerId; $i++) {
            $referrer = User::where('referral_code', $currentReferrerId)->first();
            if ($referrer) {
                // kiểm tra xem user có bị tắt tính tiền hoa hồng không
                if (!$referrer->is_commission_disabled) {
                    $result = UserWallet::where('user_id', $referrer->id)->where('wallet_id', 1)->first();
                    if ($result) {
                        $result->update([
                            'total_revenue' => $result->total_revenue + ($total_money * $rates[6 - $i])
                        ]);
                        Log::info($result);
                    } else {
                        // Dừng vòng lặp nếu không tìm thấy UserWallet
                        break;
                    }
                }
                $currentReferrerId = $referrer->referrer_id;
                // Log::info('currentReferrerId: '.$currentReferrerId);
            } else {
                break;
            }
        }

        return true;
    }


    public function getOrderAmount()
    {
        try {
            $request = Request::instance();
            if ($request->session()->has('authUser')) {
                $result = $request->session()->get('authUser');
                $role  = $result['user']['role_id'];
            }
            if ($role === 1) {
                $number = $this->order->count();
                $total = $this->order->sum('total_money');
                $result = new \Illuminate\Database\Eloquent\Collection;
                $result->push((object)[
                    'number' => $number,
                    'total' => $total,
                ]);
                return $result;
            } else if ($role === 4) {
                // $orders =  Product::where('brands_id',$result['user']['id'])->get();
                $brandId = $result['user']['id'];
                $orderDetails = OrderDetail::select('order_details.*')
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->where('products.brands_id', $brandId)
                    ->get();

                $orders = [];
                $addedOrderIds = [];
                foreach ($orderDetails as $orderDetail) {
                    $order = $orderDetail->order;
                    if ($order && !in_array($order->id, $addedOrderIds)) {
                        $orders[] = $order;
                        $addedOrderIds[] = $order->id;
                    }
                }
                // $this->order->sum('total_money')
                Log::info($orders);
                $number =  count($orders);
                $total =  array_sum(array_column($orders, 'total_money'));
                $result = new \Illuminate\Database\Eloquent\Collection;
                $result->push((object)[
                    'number' => $number,
                    'total' => $total,
                ]);
                return $result;
            }
        } catch (\Exception $e) {
            Log::error('Failed to count order: ' . $e->getMessage());
            throw new Exception('Failed to count orders');
        }
    }
    public function getBestSeller()
    {
        try {
            $request = Request::instance();
            if ($request->session()->has('authUser')) {
                $result = $request->session()->get('authUser');
                $role  = $result['user']['role_id'];
            }
            if ($role === 1) {
                $bestseller = $this->orderDetail
                    ->select(
                        'products.name as product_name',
                        'products.price',
                        'categories.name as category_name',
                        DB::raw('SUM(order_details.quantity * products.price) as total_cost'),
                        DB::raw('SUM(order_details.quantity) as total_sold_amount')
                    )
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->groupBy('products.id', 'products.name', 'categories.name', 'products.price')
                    ->orderBy('total_sold_amount', 'desc')
                    ->limit(6)
                    ->get();
                // dd($bestseller);
                return $bestseller;
            } else if ($role === 4) {
                $brandId = $result['user']['id'];
                $bestseller = $this->orderDetail
                    ->select(
                        'products.name as product_name',
                        'products.price',
                        'categories.name as category_name',
                        DB::raw('SUM(order_details.quantity * products.price) as total_cost'),
                        DB::raw('SUM(order_details.quantity) as total_sold_amount')
                    )
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->groupBy('products.id', 'products.name', 'categories.name', 'products.price')
                    ->orderBy('total_sold_amount', 'desc')
                    ->where('products.brands_id', $brandId)
                    ->limit(6)
                    ->get();

                return $bestseller;
            }
        } catch (\Exception $e) {
            Log::error('Failed to retrieve orders: ' . $e->getMessage());
            throw new Exception('Failed to retrieve orders');
        }
        // dd($result);
    }
    public function getAllOrder($type, $search, $status)
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
            $request = Request::instance();
            if ($request->session()->has('authUser')) {
                $result = $request->session()->get('authUser');
                $role  = $result['user']['role_id'];
            }
            if ($role === 1) {
                $query = Order::query();
                if ($search) {
                    $query->where('zip_code', 'like', '%' . $search . '%');
                }
                if ($status) {
                    $query->where('status', 'like', '%' . $status . '%');
                }
                $orders = $query->whereDoesntHave('orderDetails', function ($query) {
                    $query->whereNull('product_id');
                })->simplePaginate(10);           
                
            } else if ($role === 4) {
                // $orders =  Product::where('brands_id',$result['user']['id'])->get();
                $brandId = $result['user']['id'];
                $orderDetails = OrderDetail::select('order_details.*')
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('orders', 'order_details.order_id', '=', 'orders.id')
                    ->where('products.brands_id', $brandId)
                    ->when($search, function ($query, $search) {
                        return $query->where('orders.zip_code', $search);
                    })
                    ->get(); 
                $orders = [];
                $addedOrderIds = [];
                foreach ($orderDetails as $orderDetail) {
                    $order = $orderDetail->order;
                    if ($order && !in_array($order->id, $addedOrderIds)) {
                        // Kiểm tra điều kiện cho $status
                        if(empty($status) || ($status && $order->status === (int)$status)){
                            $orders[] = $order;
                            // $addedOrderIds[] = $order->id; // Bạn có thể thêm vào mảng này ở sau nếu cần
                        }
                    }
                }
                $page = request()->get('page', 1);
                $perPage = 10; 
                $total = count($orders);
                $offset = ($page - 1) * $perPage;
                $items = array_slice($orders, $offset, $perPage);
                $orders =  new LengthAwarePaginator($items, $total, $perPage, $page);
            }

            return (object) $orders;
        } catch (\Exception $e) {
            Log::error('Failed to retrieve orders: ' . $e->getMessage());
            throw new Exception('Failed to retrieve orders');
        }
    }
    public function updateStatus($data)
    {
        try {
            $orderStatus  = $this->order->find($data['order_id']);
            if ($orderStatus) {
                $orderStatus->status = $data['status'];
                $orderStatus->save();
                $orderDetail = OrderDetail::where('order_id', $orderStatus->id)->whereNotNull('package_id')->with('order')->first();
                if ($orderDetail->order['status'] === 2) {
                    $user_package = new UserPackage();
                    $user_package->create([
                        "user_id" => $orderDetail->order['user_id'][0]['id'] ?? "",
                        "package_id" => $orderDetail->package_id,
                        "start_date" => Carbon::now(),
                        "end_date" => Carbon::now()->addDays(30),
                        "is_active" => 1,
                    ]);
                } else if ($orderDetail->order['status'] === 3) {
                    UserPackage::where('user_id', $orderDetail->order['user_id'][0]['id'])
                        ->where('package_id', $orderDetail->package['id'])
                        ->delete();
                    Log::info('Xóa thành công');
                }
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
            $request = Request::instance();
            if ($request->session()->has('authUser')) {
                $result = $request->session()->get('authUser');
                $role  = $result['user']['role_id'];
            }
            if ($role === 1) {
                $order = $this->order->orderBy('created_at', 'desc')->take(5)->get();
                return $order;
            } else if ($role === 4) {
                $brandId = $result['user']['id'];
                $orderDetails = OrderDetail::select('order_details.*', 'orders.zip_code', 'orders.name', 'orders.total_money')
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('orders', 'order_details.order_id', '=', 'orders.id')
                    ->where('products.brands_id', $brandId)
                    ->take(5)
                    ->get();
                return $orderDetails;
            }
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
