<?php

namespace App\Services;

use App\Models\City;
use App\Models\Districts;
use App\Models\User;
use App\Models\Wards;
use Illuminate\Support\Facades\Auth;
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
}
