<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AffSetting;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MlmController extends Controller
{
   public function __construct()
   {
    
   }
   public function index(){
      $affSetting = AffSetting::first();
      $commissionRates = Commission::all();
      $userAffilate = User::whereIn('role_id', [2, 3])->select('id','email','name','role_id','is_commission_disabled')->get();
      return view('admin.mlm.index',['commissionRates'=>$commissionRates, 'affSetting'=> $affSetting,'userAffilate'=>$userAffilate]);
   }

   public function update(Request $request)
   {
       foreach ($request->input('commissions') as $level => $percentage) {
           Commission::where('level', $level)->update(['rate' => $percentage]);
       }

       return redirect()->route('admin.mlm')->with('success', 'Đã cập nhật tỷ lệ hoa hồng thành công!');
   }
    /**
     * Cập nhật cài đặt trạng thái tiếp thị liên kết.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:enabled,disabled,custom',
        ]);

        // Giả sử chỉ có một bản ghi trong bảng aff_settings
        $setting = AffSetting::first();

        if ($setting) {
            $setting->status = $validatedData['status'];
            $setting->save();
            return response()->json(['message' => 'Cài đặt đã được cập nhật thành công.'], 200);
        }

        return response()->json(['message' => 'Cài đặt không tồn tại.'], 404);
    }
}
