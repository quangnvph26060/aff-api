<?php

namespace App\Services;

use App\Enums\RequestApi;
use App\Events\EventRegister;
use App\Http\Responses\ApiResponse;
use App\Jobs\SendMail;
use App\Models\Commission;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Wallet;
use Baileyherbert\BankQr\BankQr;
//use Illuminate\Support\Facades\Log;
//use Exception;
use Carbon\Carbon;
use Exception;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Providers\Auth\Illuminate;

/**
 * Summary of UserService
 */

class UserService
{
    protected $user;
    protected $faker;
    protected $wallet;
    protected $userInfo;

    public function __construct(User $user, Faker $faker, Wallet $wallet, UserInfo $userInfo)
    {
        $this->user = $user;
        $this->faker = $faker;
        $this->wallet = $wallet;
        $this->userInfo = $userInfo;
    }

    /**
     * Hàm lấy ra thông tin của tất cả người dùng
     * @param $id
     * @return $user
     * CreatedBy: youngbachhh (24/05/2024)
     * UpdatedBy: youngbachhh (27/05/2024)
     */
    public function getAllUsers(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching all users');
            return $this->user->all();
        } catch (Exception $e) {
            Log::error('Failed to fetch users: ' . $e->getMessage());
            throw new Exception('Failed to fetch users');
        }
    }
    /**
     * hàm lấy thông tin người dùng
     */
    public function getUser(Request $request)
    {
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
     * Hàm lấy ra thông tin của tất cả thành viên trong nhóm
     * @param $id
     * @return $user
     * CreatedBy: youngbachhh (24/05/2024)
     * UpdatedBy: youngbachhh (27/05/2024)
     */

    // public function getAllTeamMember(): \Illuminate\Database\Eloquent\Collection
    // {
    //     try {
    //         Log::info('Fetching all users');
    //         $currentUser = Auth::user();
    //         $teamMembersB = User::where('referrer_id', $currentUser->referral_code)->with('userwallet')->get();
    //         $result = new \Illuminate\Database\Eloquent\Collection;

    //         foreach ($teamMembersB as $memberB) {
    //             $level = Commission::where('id', $memberB->commission_id)->value('level');
    //             // Lấy tổng doanh số cá nhân của thành viên B
    //             $personalRevenue = $memberB->userwallet->sum('total_revenue');

    //             // Tính tổng doanh thu của tất cả các thành viên C của thành viên B
    //             $teamRevenue = User::whereIn('referrer_id', [$memberB->referral_code])
    //                 ->with('userwallet')
    //                 ->get()
    //                 ->sum(function ($user) {
    //                     return $user->userwallet->sum('total_revenue');
    //                 });

    //             // Tạo đối tượng kết quả và thêm vào Collection
    //             $result->push((object)[
    //                 'id' => $memberB->id,
    //                 'name' => $memberB->name,
    //                 'email' => $memberB->email,
    //                 'phone' => $memberB->phone,
    //                 'referral_code' => $memberB->referral_code,
    //                 'personalRevenue' => $personalRevenue,
    //                 'teamRevenue' => $teamRevenue,
    //                 'level' => $level,
    //             ]);
    //         }

    //         // dd($result);
    //         return $result;
    //     }
    // }
    public function getTeamMember($id): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info("Getting team member of member: $id");
            $currentMember = $this->user->find($id);
            if ($currentMember) {
                $currentUser = $currentMember;
                $teamMember = User::where('referrer_id', $currentUser->referral_code)->get();
                $result = new Collection;
                foreach ($teamMember as $member) {
                    $personalRevenue = $member->userwallet->sum('total_revenue');
                    $teamRevenue = User::whereIn('referrer_id', [$member->referral_code])
                    ->with('userwallet')
                    ->get()
                    ->sum(function ($user) {
                        return $user->userwallet->sum('total_revenue');
                    });
                    $result->push((object)[
                        'id' => $member->id,
                        'name' => $member->name,
                        'email' => $member->email,
                        'phone' => $member->phone,
                        'referral_code' => $member->referral_code,
                        'personalRevenue' => $personalRevenue,
                        'teamRevenue' => $teamRevenue,
                        'level' => 'F1',
                    ]);
                }
                Log::info($result);
                return $result;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'failed to get team member'
                ]);
            }
        } catch (Exception $e) {
            Log::error('Failed to get member from users: ' . $e->getMessage());
            throw new Exception('Failed to get member from');
        }
    }

    public function getAllTeamMember(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        try {
            if ($request->is('api/*')) {
                // Xác định người dùng qua token (cho API)
                $user = Auth::user();
                if ($user) {
                    $currentUser = $user;
                    $teamMembersB = User::where('referrer_id', $currentUser->referral_code)->get();

                    // Log::info($teamMembersB);
                    $result = new \Illuminate\Database\Eloquent\Collection;
                    foreach ($teamMembersB as $memberB) {
                        // $level = Commission::where('id', $memberB->commission_id)->value('level');
                        // Lấy tổng doanh số cá nhân của thành viên B
                        $personalRevenue = $memberB->userwallet->sum('total_revenue');

                        // Tính tổng doanh thu của tất cả các thành viên C của thành viên B
                        $teamRevenue = User::whereIn('referrer_id', [$memberB->referral_code])
                            ->with('userwallet')
                            ->get()
                            ->sum(function ($user) {
                                return $user->userwallet->sum('total_revenue');
                            });

                        // Tạo đối tượng kết quả và thêm vào Collection
                        $result->push((object)[
                            'id' => $memberB->id,
                            'name' => $memberB->name,
                            'email' => $memberB->email,
                            'phone' => $memberB->phone,
                            'referral_code' => $memberB->referral_code,
                            'personalRevenue' => $personalRevenue,
                            'teamRevenue' => $teamRevenue,
                            'level' => 'F1',
                        ]);
                    }
                    Log::info($result);
                    return $result;
                }
            }else {
                $currentUser = $request->session()->get('authUser');
                $teamMembersB = User::where('referrer_id', $currentUser['user']['referral_code'])->with('userwallet')->get();
                $result = new \Illuminate\Database\Eloquent\Collection;

                foreach ($teamMembersB as $memberB) {
                    $level = Commission::where('id', $memberB->commission_id)->value('level');
                    // Lấy tổng doanh số cá nhân của thành viên B
                    $personalRevenue = $memberB->userwallet->sum('total_revenue');

                    // Tính tổng doanh thu của tất cả các thành viên C của thành viên B
                    $teamRevenue = User::whereIn('referrer_id', [$memberB->referral_code])
                        ->with('userwallet')
                        ->get()
                        ->sum(function ($user) {
                            return $user->userwallet->sum('total_revenue');
                        });

                    // Tạo đối tượng kết quả và thêm vào Collection
                    $result->push((object)[
                        'id' => $memberB->id,
                        'name' => $memberB->name,
                        'email' => $memberB->email,
                        'phone' => $memberB->phone,
                        'referral_code' => $memberB->referral_code,
                        'personalRevenue' => $personalRevenue,
                        'teamRevenue' => $teamRevenue,
                        'level' => $level,
                    ]);
                    Log::info('Fetching all users');
                    return $result;
                }
            }

        } catch (Exception $e) {
            Log::error('Failed to fetch users: ' . $e->getMessage());
            throw new Exception('Failed to fetch users');
        }
    }







    /**
     * Hàm lấy ra thông tin của người dùng theo id
     *
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     * CreatedBy: youngbachhh (24/05/2024)
     * UpdatedBy: youngbachhh (27/05/2024)
     */
    public function getUserById(int $id): User
    {
        Log::info("Fetching user with ID: $id");
        $user = $this->user->find($id);
        if (!$user) {
            Log::warning("User with ID: $id not found");
            throw new ModelNotFoundException("User not found");
        }
        return $user;
    }

    /**
     * Hàm tạo mới người dùng
     *
     * @param array $data
     * @return User
     * CreatedBy: youngbachhh (24/05/2024)
     * UpdatedBy: youngbachhh (27/05/2024)
     */

    public function sendCodeOtp($data)
    {

        try {
            Log::info("Creating a new user with phone: {$data['phone']}");
            $referral_id = $data['referral_code'];
            $findUser = $this->user->where('referrer_id', $referral_id)->get();
            $is_result = $findUser->toArray();
            $user = [
                'name' => @$data['name'],
                'email' => @$data['email'],
                'password' => Hash::make($data['password']),
                'address' => @$data['address'],
                'referral_code' => $is_result[0]['referrer_id'],
                // 'referral_code' => $this->randomReferralCode(),
                // 'referrer_id' => $data['referrer_id'],
                'phone' => @$data['phone'],
                'referrer_id' => $this->randomReferalCode(),
                'role_id' => 3,
                'status' => 'active',
                'otp' => @$data['otp'],
            ];
            $arrSendMail = [
                'type' => 'send_otp',
                'user' => $user,
                'otp' => $data['otp'],
            ];
            SendMail::dispatch($arrSendMail);
            //  event(new EventRegister($user,@$data['otp']));
            return $user;
        } catch (Exception $e) {
            Log::error("Failed to create user: {$e->getMessage()}");
            throw $e;
        }


    }

    public function resetPassword($email)
    {

        $user = User::where('email', $email)->first();
        if (!$user) {
            return false;
        }
        $newPassword = $this->generatePassword();
        // Cập nhật mật khẩu mới
        $user->password = bcrypt($newPassword);
        $user->save();
        // Gửi email mật khẩu mới
        $arrSendMail = [
            'type' => 'password_new',
            'user' => $user,
            'newPassWord' =>  $newPassword,
        ];
        SendMail::dispatch($arrSendMail);
        return true;
    }


    public function createUser(array $data)
    {
        DB::beginTransaction();
        try {
            Log::info("Creating a new user with phone: {$data['phone']}");
            $referral_id = $data['referral_code'];
            $findUser = $this->user->where('referrer_id', $referral_id)->get();
            $is_result = $findUser->toArray();

            $user = $this->user->create([
                'name' => @$data['name'],
                'email' => @$data['email'],
                'password' => Hash::make($data['password']),
                'address' => @$data['address'],
                'referral_code' => $this->randomReferalCode(),
                'phone' => @$data['phone'],
                'referrer_id' => $is_result[0]['referrer_id'],
                'role_id' => 3,
                'status' => 'active',
            ]);

            $wallets = $this->wallet->all()->pluck('id')->toArray();
            foreach ($wallets as $wallet) {
                $user->wallet()->attach($wallet);
            }
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to create user: {$e->getMessage()}");
            throw $e;
        }
    }
    /**
     * Cập nhật thông tin người dùng
     *
     * @param int $id
     * @param array $data
     * @return User
     * @throws ModelNotFoundException
     * CreatedBy: youngbachhh (24/05/2024)
     * UpdatedBy: youngbachhh (27/05/2024)
     */
    public function updateUser(int $id, array $data): User
    {
        DB::beginTransaction();

        try {
            $user = $this->getUserById($id);

            Log::info("Updating user with ID: $id");
            $user->update($data);

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update user: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Xóa người dùng
     *
     * @param int $id
     * @throws ModelNotFoundException
     * CreatedBy: youngbachhh (24/05/2024)
     * UpdatedBy: youngbachhh (27/05/2024)
     */
    public function deleteUser(int $id): void
    {
        DB::beginTransaction();

        try {
            $user = $this->getUserById($id);

            Log::info("Deleting user with ID: $id");
            $user->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete user: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Random mã giới thiệu
     *
     * @param void
     * @return $rand
     * CreatedBy: svellsongur (28/05/2024)
     * UpdatedBy: svellsongur (30/05/2024)
     */
    protected function randomReferalCode()
    {
        $rand =  "RI" . $this->faker->numberBetween(10000000, 99999999);

        $exist_user = User::where('referral_code', $rand)->exists();
        while ($exist_user) {
            $this->randomReferalCode();
        }

        return $rand;
    }
    /**
     * Hàm lấy check thông tin user đăng nhập
     */
    public function authenticateUser($credentials, Request $request)
    {
        // Tìm user theo email hoặc số điện thoại
        $user = User::where('phone', $credentials['phone'])
            ->orWhere('email', $credentials['phone'])
            ->first();
        $userRoleId = $user->role_id;
        // dd($userRoleId);
        if ($request->type === RequestApi::WEB) {
            if($userRoleId != 1)
            {
                throw new Exception('Not an admin');
            }
        } elseif ($request->type === RequestApi::API) {
            if($userRoleId != 2)
            {
                throw new Exception('Not a user');
            }
        }
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new Exception('Unauthorized');
        }

        // Đăng nhập người dùng và lấy token
        $token = Auth::login($user);
        if (!$token) {
            throw new \Exception('Could not create token');
        }

        return ['user' => $user, 'token' => $token];
    }

    /**
     * Hàm random mật khẩu
     */
    public function generatePassword(): string
    {
        $length     = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password   = '';

        do {
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])/', $password));

        return $password;
    }

    public function changePassword($userId, $currentPassword, $newPassword, $confirmPassword)
    {
        $admin = User::findOrFail($userId);
        if (!Hash::check($currentPassword, $admin->password)) {
            return [
                'status' => 'error',
                'message' => 'Mật khẩu hiện tại không đúng !'
            ];
        }
        if ($newPassword !== $confirmPassword) {
            return [
                'status' => 'error',
                'message' => 'Xác nhận mật khẩu không đúng !'
            ];
        }
        $admin->password = Hash::make($newPassword);
        $admin->save();
        return [
            'status' => 'success',
            'message' => 'Đổi mật khẩu thành công !'
        ];
    }

    public function getUserInfoById(int $userId): UserInfo
    {
        $userInfo = UserInfo::where('user_id', $userId)->first();;
        if (!$userInfo) {
            Log::warning("User with ID: $userId not found");
            throw new Exception('User information not found.');
        }

        return $userInfo;
    }

    /**
     * Summary of createUserById
     * @param int $id
     * @param array $data
     * @return UserInfo
     */
    public function updateUserInfoById(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $img = "https://img.vietqr.io/image/";
            $userinfo = UserInfo::where('user_id', $id)->first();
            $fontImagePath = '';
            $backImagePath = '';

            //Handle font image upload
            if (isset($data['font-image']) && $data['font-image'] instanceof UploadedFile && $data['font-image']->isValid()) {
                $imageFont = $data['font-image'];
                $fontImageName = 'image_'.$imageFont->getClientOriginalName();
                $fontImagePath = 'storage/cccd/cccd'.$id . '/' . $fontImageName;
                if (!Storage::exists($fontImagePath)) {
                    $imageFont->storeAs('public/cccd/cccd'.$id, $fontImageName);
                }
            }

            if (isset($data['back-image']) && $data['back-image'] instanceof UploadedFile && $data['back-image']->isValid()) {
                $imageBack = $data['back-image'];
                $backImageName = 'image_'.$imageBack->getClientOriginalName();
                $backImagePath = 'storage/cccd/cccd'.$id . '/' . $backImageName;

                if (!Storage::exists($backImagePath)) {
                    $imageBack->storeAs('public/cccd/cccd'. $id, $backImageName);
                }
            }

            if ($userinfo) {
                $userinfo->update([
                    "front_image" => isset($data['font-image']) ? $fontImagePath : $userinfo->front_image,
                    "back_image" =>  isset($data['back-image'])?  $backImagePath : $userinfo->back_image,
                    "citizen_id_number" =>  @$data['citizen_id_number'],
                    "bank" => @$data['bank'],
                    "idnumber" =>  @$data['idnumber'],
                    "bank_name" =>  @$data['bank_name'],
                    'branch' => $img."MB-".$data['idnumber'].'-qr_only.png'
                ]);

            } else {
                $userinfo = UserInfo::create([
                    'user_id' => $id,
                    "front_image" => $fontImagePath,
                    "back_image" =>   $backImagePath,
                    "citizen_id_number" =>  @$data['citizen_id_number'],
                    "bank" =>  @$data['bank'],
                    "idnumber" =>  @$data['idnumber'],
                    "bank_name" =>  @$data['bank_name'],
                    'branch' => $img."MB-".$data['idnumber'].'-qr_only.png'
                ]);
            }

            DB::commit();
            return $userinfo;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to create user: {$e->getMessage()}");
            throw $e;
        }
    }


    /**
     * hàm upload images user
     */
    public function uploadImageUserInfo($data)
    {

    }
}

