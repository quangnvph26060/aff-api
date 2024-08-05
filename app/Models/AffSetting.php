<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffSetting extends Model
{
    use HasFactory;
    protected $table = 'aff_settings';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'status',
    ];

}
