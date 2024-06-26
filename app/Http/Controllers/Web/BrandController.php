<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    protected $brandService;
    public function __construct(BrandService $brandService){
        $this->brandService = $brandService;
    }
    public function index(){
        $brand = $this->brandService->getAllBrand();
        dd($brand);
    }

    public function addForm(){
       return view('admin.brand.addbrand');
    }
}
