<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Log;

use App\Exceptions\ProductNotFoundException;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\Category\StoreCategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * hàm lấy danh tât cả danh mục
     */
    public function index()  {
       try{
            $data = $this->categoryService->getAllCategories();
            return view('admin.category.category',compact('data'));
        }catch(\Exception $e){
            Log::error('Failed to get category: ' . $e->getMessage());
            return view('admin.category.category', ['error' => 'Failed to get category']);
        }
    }
    /**
     * hàm thêm danh mục
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->createCategory($request->validated());
            session()->flash('success', 'Danh mục đã được tạo thành công.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Failed to create category: ' . $e->getMessage());
            return ApiResponse::error('Failed to create category', 500);
        }
    }

}
