<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function getTeamMember($id)
    {
        try {
            if (!$id) {
                return ApiResponse::error('ID not provided', 400);
            }
            $member = $this->userService->getTeamMember($id);
            return ApiResponse::success($member);
        } catch (\Exception $e) {
            Log::error('Failed to fetch product: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch product', 500);
        }
    }
    public function index(Request $request)
    {
        try {
            $data = $this->userService->getAllTeamMember($request);
            // dd($data);
            // dd($data);
            // Trích xuất thông tin cần thiết từ dữ liệu
            $teamMembers = $data->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'email' => $member->email,
                    'phone' => $member->phone,
                    'personal_sale' => $member->personalRevenue,
                    'team_sale' => $member->teamRevenue,
                    'level' => $member ->level,
                    'referral_code' => $member->referral_code,

                ];
            });
            // dd($teamMembers);
            // Trả về dữ liệu dưới dạng JSON
            return response()->json([
                'status' => 'success',
                'data' => $teamMembers,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch users: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to fetch users'], 500);
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
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $cr)
    {
        //
    }
    public function changeGroup(Request $request){
        try {
            Log::info("change memberCode: ". $request->memberCode);
            $memberCode = $request->memberCode;
            $teamLeaderCode = $request->teamLeaderCode;

            if (empty($memberCode) || empty($teamLeaderCode)) {
                return ApiResponse::error('Member code and team leader code are required.', 400);
            }
          
            $user = User::where('referral_code',$memberCode)->first();
            if(!$user){
                return ApiResponse::error('User with given member code not found',500);
            }
            $updateSuccess = $user->update(['referrer_id'=>$teamLeaderCode]);
          
            if ($updateSuccess) {
                return ApiResponse::success('', 'Change group success!', 200);
            } else {
                return ApiResponse::error('Failed to update user information.', 500);
            }
          
        } catch (\Throwable $e) {
            Log::error('Failed to fetch users: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to fetch users'], 500);
        }
    }
}
