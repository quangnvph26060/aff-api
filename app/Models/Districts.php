<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table= "districts";
    protected $fillable = [
        'city_id',
        'name',
        'id',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
