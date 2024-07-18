<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    use HasFactory;
    protected $table = "user_packages";
    protected $fillable = [
        "user_id",
        "package_id",
        "start_date",
        "end_date",
        "is_active",
    ];
    protected $appends = ['package'];
    public function getPackageAttribute(){
        return Packages::where('id', $this->attributes['package_id'])->get();
    }
}
