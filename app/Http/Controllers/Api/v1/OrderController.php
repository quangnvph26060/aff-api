<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\RequestApi;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Method;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Carbon\Carbon;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *b
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $orders = $this->orderService->getAllOrder($type = 'api',$request->input('search'),$request->input('status'));
            return ApiResponse::success($orders, 'Get Orders successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to fetch orders: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch orders', 500);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createOrder(Request $request)
    {
        try{
            $order = $this->orderService->createOrder($request->all());
            return ApiResponse::success('Order created successfully', 201);
        }
        catch(ModelNotFoundException $e){
            $exception = new UserNotFoundException();
            return $exception -> render(request());
        }
        catch(\Exception $e){
            Log::error('Failed to create order: ' .$e ->getMessage());
            return ApiResponse::error('Failed to create order', 500);
        }
    }

    public function getOrderNew(){

        try{
            $order = $this->orderService->getOrderNew();
            return ApiResponse::success($order,'success', 201);
        }
        catch(\Exception $e){
            Log::error('Lỗi thông tin đơn hàng: ' .$e ->getMessage());
            return ApiResponse::error('Lỗi thông tin đơn hàng', 500);
        }

    }
    /**
     *  user có thể xóa đơn hàng của user khi ở trạng thái chờ xử lý 
     */
    public function delOrderUser(Request  $request){
        $id = $request->orderId;
        if(!$id){
            return response()->json(['errors'=>'delOrderUser error id','status'=>'errors']);
        }
        $order  = Order::find($id);
        $orderDetail  = OrderDetail::where('order_id',$id);
        if(!$order && !$orderDetail){
            return response()->json(['errors'=> 'delOrderUser error find order','status'=>'errors']);
        }
        $orderDetail->delete();
        $order->delete();
        return response(['status'=>'success','Delete Order to user success']);
    }

    // private function saveOrder($data)
    // {
    //     return $order;
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * hàm đếm order
     */
    public function orderCount()
    {
        try {
            $orderCount = Order::where('notify', 0)->count();
            return response()->json(['orderCount' => $orderCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * change  status notify order
     */
    public function updateNotify(Request $request)  {
        try {
            $this->orderService->updateNotify($request->id);
            $orderCount =   $this->orderCount();
            return response()->json(['orderCount' => $orderCount]);
        } catch(ModelNotFoundException $e){
            $exception = new OrderNotFoundException();
            return $exception -> render(request());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * handle all status order
     */
    public function handleAllNotify(Request $request)  {
        try {
            $orders = Order::where('notify',0)->get();
            foreach ($orders as $order) {
                $order->update(['notify' => 1]);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function getOrderInMonth(){
        $userId = Auth::id();
        $now = Carbon::now();

        $sumTotalOrder = Order::query()
                          ->where('user_id', $userId)
                          ->whereMonth('created_at', $now->month)
                          ->whereYear('created_at', $now->year)
                          ->sum('total_money');
        return response()->json(['data' => $sumTotalOrder, 'status' => 'success']);

    }
    public function getMethodPayment(){
        $methods = Method::where('active',RequestApi::T_ACTIVE)->get();
        return response()->json(['data' => $methods, 'status' => 'success']);
    }
}
