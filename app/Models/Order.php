<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        "total_money",
        "status",
        "note",
        "receive_address",
        "user_id",
        'name',
        'phone',
        'zip_code',
        'notify',
        'payment_method',
    ];
    protected $appends = ['order_detail','user_id','package'];
    public function getOrderDetailAttribute(){
        return OrderDetail::where('order_id', $this->attributes['id'])->with('product','package')->get();
    }
    public function  getPackageAttribute(){
        return OrderDetail::where('order_id', $this->attributes['id'])->with('package')->get();
    }
    public function getUserIdAttribute(){
        return User::where('id', $this->attributes['user_id'])->get();
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class)->with('product');
    }
    public function orderDetailPackage()
    {
        return $this->hasMany(OrderDetail::class)->with('package');
    }
    public function ship()
    {
        return $this->hasOne(Ship::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function package(){

        return $this->hasMany(OrderDetail::class)->width('package');
    }
}
