<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAdminRequest;
use App\Http\Responses\ApiResponse;
use App\Models\City;
use App\Models\Districts;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Wards;
use App\Services\AdminService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Summary of AdminController
 */
class AdminController extends Controller
{
    protected $adminService;
    protected $userService;

    public function __construct(AdminService $adminService, UserService $userService)
    {
        $this->adminService = $adminService;
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            if ($request->session()->has('authUser')) {
                $user = $request->session()->get('authUser');
                $userInfor = UserInfo::where('user_id', $user['user']['id'])->first();
                $admin = User::find($user['user']['id']);
                $city = City::all();
                $districts = Districts::all();
                $wards = Wards::all();
                return view('admin.user.index', compact('admin','wards','city','districts','userInfor'));
            }
        }
        catch(\Exception $e)
        {
            Log::error('Failed to fetch admin infor: '. $e->getMessage());
            return ApiResponse::error('Failed to fetch admin infor', 500);
        }
    }

    public function editAdmin(Request $request) {
        try {
            if ($request->session()->has('authUser')) {
                $user = $request->session()->get('authUser');
                $adminId = User::find($user['user']['id'])->id;
                
                // Validate dữ liệu
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'city_id' => 'required|integer',
                    'district_id' => 'required|integer',
                    'wards_id' => 'required|integer',
                    'address' => 'required|string|max:255',
                    'phone' => 'required|string|regex:/^(\d{10,11})$/',
                    'email' => 'required|string|email|max:255|unique:users,email,' . $adminId,
                ]);
                
                // Kiểm tra lỗi xác thực
                if ($validator->fails()) {
                    Log::error('Validation errors: ' . json_encode($validator->errors()->all()));
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $validatedData = $validator->validated();
                 $this->adminService->updateAdmin($adminId, $validatedData);
                return redirect()->route('admin.user-info');
            }
        } catch(\Exception $e) {
            Log::error('Failed to update admin: ' . $e->getMessage());
            return ApiResponse::error('Failed to update admin', 500);
        }
    }

    /**
     * Summary of editInfoAdmin
     * @param Request $request

     */
    public function editInfoAdmin(Request $request){
        try {
            if ($request->session()->has('authUser')) {
                // dd($request->all());
                $user = $request->session()->get('authUser');

                $this->userService->updateUserInfoById($user['user']['id'], $request->all());
                return redirect()->route('admin.user-info')->with('dinhdanh', 'Định danh thông tin thành công');
            }
        } catch(\Exception $e) {
            Log::error('Failed to update user info: ' . $e->getMessage());
            return ApiResponse::error('Failed to update  user info', 500);
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
    public function store(Request $request)
    {
        //
    }

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
}
