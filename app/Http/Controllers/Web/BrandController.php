<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    //
    protected $brandService;
    public function __construct(BrandService $brandService){
        $this->brandService = $brandService;
    }
    public function index(){
        $brand = $this->brandService->getAllBrand();
        return view('admin.brand.brand', compact('brand'));
    }

    public function addForm(){
       return view('admin.brand.addbrand');
    }

    public function add(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'images' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size as needed
            
        ]);

        // Map validated data to the required array format
        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'images' => $validatedData['images'],
        ];

        $this->brandService->createBrand($data);
        // dd($request->all());
        return redirect()->route('admin.brand.index')->with('success', 'Thêm thành công');
     }

     public function edit($id){
        $brand = $this->brandService->getBrandById($id);
       return view('admin.brand.editbrand', compact('brand'));
     }

     public function update($id, Request $request){
        $brand = $this->brandService->updateBrand($id, $request->all());
        return redirect()->route('admin.brand.index')->with('success', 'Thêm thành công');
     }

     public function search(Request $request){
        try {

            $brand = $this->brandService->brandtByName($request->name);

                return view('admin.brand.brand', compact('brand'));

        } catch (\Exception $e) {
            Log::error('Failed to search brand: ' . $e->getMessage());
            return ApiResponse::error('Failed to dsearch brand', 500);
        }
     }
}
