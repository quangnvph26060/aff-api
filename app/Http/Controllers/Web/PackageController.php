<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\OrderDetail;
use App\Models\Packages;
use App\Services\PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    protected $package;
    public function __construct(PackageService $package)
    {
        $this->package = $package;
    }
    public function index(){
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
        $orders = OrderDetail::select('order_details.*', 'orders.*', 'users.referral_code')
                ->join('packages', 'order_details.package_id', '=', 'packages.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->with('package')
                ->get();
        $title = 'Danh sách đơn hàng';
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

}
