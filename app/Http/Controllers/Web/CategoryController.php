<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\CategoryNotFoundException;
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
    /*
    hàm xóa danh mục theo id
    @pram $id
    */
    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            session()->flash('success', 'Xóa danh mục thành công.');
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            $exception = new CategoryNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to delete category: ' . $e->getMessage());
            return ApiResponse::error('Failed to delete category', 500);
        }
    }
    /**
     * hàm hiển thị ra form edit
     */
    public function edit($id)
    {
        try{
            $category = $this->categoryService->findOrFailCategory($id);
            return view('admin.category.editcategory', compact('category'));
        }
        catch (ModelNotFoundException $e) {
            $exception = new CategoryNotFoundException();
            return $exception->render(request());
        }catch(\Exception $e){
            Log::error('Failed to find category: ' . $e->getMessage());
        }


    }
    public function update($id, Request $request)
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->all());
            session()->flash('success', 'Cập nhật  danh mục thành công.');
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            $exception = new CategoryNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to update category: ' . $e->getMessage());
            return ApiResponse::error('Failed to update category', 500);
        }
    }
}
