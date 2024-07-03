<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function demoCors(Request $request){
        // Tạo mới một CURL
        $ch = curl_init();
        
        // Cấu hình cho CURL
        curl_setopt($ch, CURLOPT_URL, "http://123.31.31.39:8080/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // Thực thi CURL
        curl_exec($ch);
        
        // Ngắt CURL, giải phóng
        $result = curl_close($ch);
        return response()->json(['data'=>$result]);
    }
}
