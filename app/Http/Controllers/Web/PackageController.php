<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
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

}
