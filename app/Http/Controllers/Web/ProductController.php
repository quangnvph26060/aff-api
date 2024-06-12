<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductService;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Exceptions\ProductNotFoundException;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {

        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }


    // show screen product
    public function store()
    {
        try {
            $products = $this->productService->getAllProducts();
            $category = $this->categoryService->getAllCategories();
            return view('admin.products.listproduct', compact('products', 'category'));
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }
    public function addForm()
    {
        try {
            $category = $this->categoryService->getAllCategories();
            return view('admin.products.add', compact('category'));
        } catch (\Exception $e) {
            Log::error('Failed to create category: ' . $e->getMessage());
            return ApiResponse::error('Failed to create category', 500);
        }
    }
    public function addSubmit(StoreProductRequest $request)
    {
        try {

            $product = $this->productService->createProduct($request->all());
            return redirect()->route('admin.product.store')->with('success', 'Thêm sản phẩm thành công');
            // return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create product: ' . $e->getMessage());
            return ApiResponse::error('Failed to create product', 500);
        }
    }

    public function editForm($id){

        $product = $this->productService->getProductById($id);
        $category = $this->categoryService->getAllCategories();
        // dd($product);
        return view('admin.products.edit', compact('product', 'category'));
    }
    public function editSubmit(Request $request, $id){
        try {
            $product = $this->productService->updateProduct($id, $request->all());
            return redirect()->route('admin.product.store')->with('success', 'Cập nhật sản phẩm thành công');
            // return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to update product: ' . $e->getMessage());
            return ApiResponse::error('Failed to update product', 500);
        }
    }

    public function delete($id){
        try {
            $this->productService->deleteProduct($id);
            return redirect()->route('admin.product.store');
            // return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return ApiResponse::error('Failed to delete product', 500);
        }
    }
    public function search(Request $request){
        try {
            $category = $this->categoryService->getAllCategories();
            $products = $this->productService->productByName($request->name);

            if($products->count() >0){
                return view('admin.products.listproduct', compact('products','category'));
            }else{
                return redirect()->route('admin.product.store')->with('fail', 'Không tìm thấy sản phần có ký tự : '.$request->name);
            }
            // return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return ApiResponse::error('Failed to delete product', 500);
        }
    }
    public function productFilter($id){

        try {

            $category = $this->categoryService->getAllCategories();
            $products = $this->productService->productByCategory($id);
            $category_name = $this->categoryService->findOrFailCategory($id)->name;
            if($products->count() >0){
                return view('admin.products.listproduct', compact('products','category'));
            }else{
                return redirect()->route('admin.product.store')->with('fail', 'Không tìm thấy sản phần có tên loại  : '.$category_name);
            }

            // return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return ApiResponse::error('Failed to delete product', 500);
        }


    }
}
