<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brand;
    public function __construct(BrandService $brand)
    {
        $this->brand = $brand;

    }
    public function imageBrand() {
        return $this->brand->imageBrand();
    }
}
