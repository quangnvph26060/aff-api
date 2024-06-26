<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Districts;
use App\Models\Wards;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function city(){
        $result = City::all();
        return response()->json(['status'=>'success','results'=>$result]);
    }
    public function district($id){
        if(!$id){
            return response()->json(['status'=>'success','results'=>[]]);
        }
        $result = Districts::where('city_id',$id)->get();
        return response()->json(['status'=>'success','results'=>$result]);
    }
    public function wards($id){
        if(!$id){
            return response()->json(['status'=>'success','results'=>[]]);
        }
        $result = Wards::where('district_id',$id)->get();
        return response()->json(['status'=>'success','results'=>$result]);
    }
}
