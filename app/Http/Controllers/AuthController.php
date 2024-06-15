<?php

namespace App\Http\Controllers;

//use http\Env\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Models\UserInfo;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Array_;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
        $this->userService = $userService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    // public function login(Request $request)
    // {
    //     $user = User::where('phone', $request->phone)->orwhere('email',$request->phone)->first();
    //     if ($user && Hash::check($request->get('password'), $user->password)) {
    //         if (!$token = Auth::login($user)) {
    //             // return ApiResponse::error('Unauthorized', 401);
    //             return redirect()->back();
    //         }
    //         if ($request->type === 'loginadmin') {
    //             session()->put('authUser', true);
    //             return redirect()->route('product.store');
    //         }
    //         return $this->respondWithToken($token);
    //     }
    //     return ApiResponse::error('Error', 401);
    // }
    public function login(Request $request)
    {
        try {
            // $credentials = $this->filterUserData($request->all());
            $credentials = $request->only(['phone', 'password']);
            $result = $this->userService->authenticateUser($credentials);
            // Kiểm tra loại đăng nhập và thực hiện hành động phù hợp
            if ($request->type === 'loginadmin') {
                session()->put('authUser', $result);
                return redirect()->route('admin.product.store');
            } elseif ($request->type === 'fe') {
                return $this->respondWithToken($result['token']);
            }
        } catch (\Exception $e) {
            return $this->handleLoginError($request, $e);

        }
    }
    /**
     * hàm check key $data
     */
    protected function filterUserData(array $data): array
    {
        return array_filter($data, function ($key) {
            return in_array($key, ['phone', 'password','type']);
        }, ARRAY_FILTER_USE_KEY);
    }
    protected function handleLoginError($request, \Exception $e)
    {
        if ($request->type === 'loginadmin') {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        } else {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
    /**
     * Get the authenticated User. ( thông tin user )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {

        if($request->type === "web"){
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login');
        }
        $user = User::where('id', Auth::user()->id)->first();
        $user->tokens()->delete();
        Auth::logout();
       return ApiResponse::success('Successfully logged out', 201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = auth()->user();
        if(($user->role->name === "Admin")){
            $role = "Admin";
        }else {
            $role = "User";
        }
        $user->tokens()->delete();
        return response()->json([
            'accessToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'userAbilityRules' => [
                [
                    'action' => 'manage',
                    'subject' => 'all'
                ]
            ],
            'userData' => $user,
            'status' => 'success',
            'role' => $role,
        ]);
    }
    /**
     * hàm lấy thông tin người dùng
     */
    public function getUser(Request $request) {
        if ($request->is('api/*')) {
            // Xác định người dùng qua token (cho API)
            $user = Auth::user();
            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'data' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthenticated',
                ], 401);
            }
        } else {
            // Xác định người dùng qua session (cho web)
            if ($request->session()->has('authUser')) {
                $user = $request->session()->get('authUser');
            }
             return $user;
        }
    }

     /**
     * Thay đổi mật khẩu
     */

    public function ChangePassword(Request $request)
    {
        if ($request->session()->has('authUser')) {
            $user = $request->session()->get('authUser');
            dd($user);
            $id = $user['user']->id;
            $result = $this->userService->changePassword(
                $id,
                $request->password,
                $request->newPassword,
                $request->confirmPassword
            );
            return redirect()->back()->with($result['status'], $result['message']);
        }

    }
    /**
     * hàm hiển thị view login
     */
    public function viewLogin(){
        return view('admin.login');
    }
    /*
     * hàm upload ảnh  user
     */
    public function uploadImageUserInfo(Request $request)
    {
        $user = $this->getUser($request);
        if ($request->file()) {
            $file = $request->file('file');
            $filePath = uploadFile('User', $file);
            $filename = 'storage/images/' . $filePath;

            $result = UserInfo::where('user_id', $user['user']->id)->first();

            if (!$result) {
                $user_info = new UserInfo();
                $user_info->img_url = $filename;
                $user_info->user_id = $user['user']->id;
                $user_info->save();
            } else {
                $result->update([
                    'img_url' => $filename
                ]);
            }
            return redirect()->back();
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }


}
