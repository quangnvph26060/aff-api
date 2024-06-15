<?php

namespace App\Services;

use App\Models\City;
use App\Models\Districts;
use App\Models\User;
use App\Models\Wards;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminService
{
    protected $user;
    protected $city;
    protected $district;
    protected $ward;

    public function __construct(User $user, City $city, Districts $district, Wards $ward)
    {
        $this->user = $user;
        $this->city = $city;
        $this->district = $district;
        $this->ward = $ward;
    }

    // public function getAdminInfor()
    // {
    //     Log::info('Fetching admin information');
    //     $id = Auth::user();
    //     // dd($this->user->find($id));
    //     return $this->user->find($id);
    // }
    public function getUserById(int $id): User {
        Log::info("Fetching user with ID: $id");
        $user = $this->user->find($id);
        if (!$user) {
            Log::warning("User with ID: $id not found");
            throw new ModelNotFoundException("User not found");
        }
        return $user;
    }

    public function updateAdmin(int $id, array $data): User {
        DB::beginTransaction();

        try {
            $admin = $this->getUserById($id);
            Log::info("Updating user with ID: $id");
            $admin->update($data);

            DB::commit();
            return $admin;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update user: {$e->getMessage()}");
            throw $e;
        }
    }



}
