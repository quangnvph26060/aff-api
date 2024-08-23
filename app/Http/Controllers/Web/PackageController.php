<?php

namespace App\Http\Controllers\Web;

use App\Enums\RequestApi;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Method;
use App\Models\OrderDetail;
use App\Models\Packages;
use App\Services\PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    protected $package;
    public function __construct(PackageService $package)
    {
        $this->package = $package;
    }
    public function index(Request $request){
       
        $package = Packages::all();
        return view('admin.package.index',compact('package'));
    }

    public function viewAdd()  {
        return view('admin.package.add');
    }

     public function store(Request $request){
         try{
            $this->package->store($request->all());
            session()->flash('success','Thêm gói tháng thành công!');
            return redirect()->back();
         }catch (\Exception $e){
             return ApiResponse::error('Error add package', 500);
         }
     }
     public function edit($id)
     {
         try {
             $package = Packages::findOrFail($id);
             return view('admin.package.edit', compact('package'));
         } catch (\Exception $e) {
             return ApiResponse::error('Error editing the package', 404);
         }
     }
     public function  update(Request $request , $id)
     {
         try {
             $this->package->update($request->all(),$id);
             session()->flash('success','Cập nhật gói tháng thành công!');
             return redirect()->back();
         }catch (\Exception $e) {
             Log::error('Error editing the package', ['error' => $e->getMessage()]);
             return ApiResponse::error('Error editing the package', 404);
         }
     }
     public function packageList(Request $request)
    {
        try {
            $search = $request->input('search'); // Điều kiện tìm kiếm
            $category = $request->input('status'); // Lọc theo trạng thái đơn hàng

        $orders = OrderDetail::select('order_details.*', 'orders.*', 'users.referral_code')
                ->join('packages', 'order_details.package_id', '=', 'packages.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->with('package');
                if ($search) {
                    $orders->where('orders.zip_code', 'like', '%' . $search . '%');
                }
                
                // Thêm điều kiện lọc theo trạng thái
                if ($category) {
                    $orders->where('orders.status', $category); // Hoặc điều kiện tùy chỉnh khác
                }
                
                // Phân trang kết quả
                $orders = $orders->simplePaginate(10);
            
        $title = 'Danh sách gói tháng';
        if ($request->session()->has('authUser')) {
            $result = $request->session()->get('authUser');
            $role  = $result['user']['role_id'];
        
        }
        return view('admin.order.package-list', compact('orders','title','role'));
        } catch (\Exception $e) {
        Log::error('Failed to fetch orders: ' . $e->getMessage());
        return ApiResponse::error('Failed to fetch orders', 500);
        }
    }

    // pay 
    public function getPay () {
        $data = Method::all();
        $title = "Phương thức thanh toán";
        return view('admin.pay.index',compact('data','title'));
    }

    public function updateStatusPay(Request $request)  {

        $id_pay     = $request->id_pay;
        $status     = $request->status;
    
        $result     = Method::find($id_pay);

        if(!$result){
            return response()->json(['status'=>'errors','update status failer']);
        }
        $result->update(['active'=>$status]);

        return response()->json(['status'=>'success','update status success']);
    }
    public function delete($id) {
        if(!$id){
            return redirect()->route('admin.pay');
        }
        $pay = Method::find($id);
        if(!$pay){
            return ApiResponse::error('Find method pay errors', 500);
        }
        $pay->delete();
        session()->flash('success','Xóa phương thức thanh toán thành  cống!');
        return redirect()->back();
    }
    public function storePay(Request $request) {
        DB::beginTransaction();
    
        try {
            $name = $request->input('namepay');
            $method = Method::create([
                'name' => $name,
                'active' => RequestApi::T_ACTIVE,
            ]);
    
            DB::commit(); 
    
            session()->flash('success', 'Thêm phương thức thanh toán thành công!');
    
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack(); 

            session()->flash('error', 'Thêm phương thức thanh toán thất bại!'); 

            return ApiResponse::error('Failed to create method', 500);
        }
    }
}
