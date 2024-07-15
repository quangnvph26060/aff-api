<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
   public function  __construct()
   {
    
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
}
