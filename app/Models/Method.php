<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $table = 'methods';
    protected $fillable = [
        'wallet_id',
        'user_id',
        'amount',
        'status',
        'method_id'
    ];
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'method_id');
    }

}
