<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        "email",
        "name",
        "address",
        "password",
        "referral_code",
        'referrer_id',
        'phone',
        'role_id',
        'status',
        'city_id',
        'district_id',
        'wards_id',
        'is_commission_disabled',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends = ['role','wallet','user_info'];

    public function getUserInfoAttribute(){
        return UserInfo::where('user_id', $this->attributes['id'])->get();
    }
    public function getWalletAttribute(){
        return  UserWallet::where('user_id', $this->attributes['id'])->get();
    }
    public function getRoleAttribute(){
        return  Role::where('id',$this->attributes['role_id'])->first();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function userwallet(){
        return $this -> hasMany(UserWallet::class);
    }
    public function city(){
        return $this -> belongsTo(City::class);
    }
    public function district(){
        return $this -> belongsTo(Districts::class);
    }
    public function ward(){
        return $this -> belongsTo(Wards::class);
    }
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }
    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
    public function role()
    {
        return $this->hasOne(Role::class);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function ship()
    {
        return $this->hasMany(Ship::class);
    }
    public function wallet()
    {
        return $this->belongsToMany(Wallet::class)->withTimestamps();
    }
    // gói tháng
    public function activeUserPackage()
    {
        return $this->hasOne(UserPackage::class)
                    ->where('is_active', 1)
                    ->where('end_date', '>=', Carbon::now())
                    ->where('user_id', $this->id);
    }
    // bình luận
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id');
    }
    public function level($user)
    {
        // Xác định cấp độ của người dùng dựa trên referrer_id
        $level = 1;
        while ($user->referrer_id) {
            $user = User::where('referral_code', $user->referrer_id)->first();
            $level++;
        }
        return $level;
    }
}
