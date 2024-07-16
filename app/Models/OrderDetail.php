<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $fillable = [
        "quantity",
        // "price",
        // "total_money",
        "order_id",
        "product_id",
        "package_id",
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function package()
    {
        return $this->belongsTo(Packages::class);
    }
}
