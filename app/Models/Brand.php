<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Brand extends Authenticatable implements JWTSubject
{
    use HasFactory,Notifiable;
    protected $table = 'brands';
    protected $fillable = ['name', 'logo', 'email', 'phone', 'address','role_id','password'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
