<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\City;
use App\Models\Districts;
use App\Models\User;
use App\Models\Wards;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
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
                $admin = User::find($user['user']['id']);
                $city = City::all();
                $districts = Districts::all();
                $wards = Wards::all();

                return view('admin.user.index', compact('admin','wards','city','districts'));
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
                $admin = $this->adminService->updateAdmin($adminId, $request->all());
                return redirect()->route('admin.user-info');
            }
        } catch(\Exception $e) {
            Log::error('Failed to update admin: ' . $e->getMessage());
            return ApiResponse::error('Failed to update admin', 500);
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
