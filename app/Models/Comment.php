<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content', 'user_id', 'product_id', 'parent_id', 'rate'
    ];
    protected $appends = ['user_name','image_product'];
    public function getUserNameAttribute(){
        return User::where('id',$this->attributes['user_id'])->pluck('name')->first();
    }
    public function getImageProductAttribute(){
        return Product::where('id',$this->attributes['product_id'])->with('images')->first();
    }
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
