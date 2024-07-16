<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Packages;
use App\Services\PackageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
  protected $orderService;

  public function __construct(PackageService $orderService)
  {
      $this->orderService = $orderService;
  }
    public function index(){
        $package = Packages::all();
        return response()->json(['data'=>$package,'status'=>'success']);
    }
    public function DetailPackage($id) {
      try{
        $package = Packages::find($id);
        return response()->json(['data'=>$package,'status'=>'success']);
      }catch(\Exception $e){
        Log::error('Find package errors: ' . $e->getMessage());
        return ApiResponse::error('Find package errors', 500);
      }
    }
    
    public function createOrder(Request $request)
    {
        try{
            $order = $this->orderService->createOrder($request->all());
            return ApiResponse::success('Order package created successfully', 201);
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
}
