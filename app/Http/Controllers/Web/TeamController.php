<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

    public function index(Request $request)
    {
        try {
            $data = $this->userService->getAllTeamMember($request);
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
                    'level' => $member ->level
                ];
            });
            // dd($teamMembers);
            // Trả về dữ liệu dưới dạng JSON
            // return response()->json([
            //     'status' => 'success',
            //     'data' => $teamMembers,
            // ]);
            return view('admin.team.team', compact('teamMembers'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch users: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to fetch users'], 500);
        }
    }
}
