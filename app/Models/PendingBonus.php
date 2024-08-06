<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingBonus extends Model
{
    use HasFactory;
    protected $table = 'pending_bonuses';
    protected $fillable = [
        'user_id',
        'amount',
        'eligible_date',
        'processed',
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
