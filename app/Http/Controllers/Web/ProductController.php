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
        $admin = Auth::user();

        try {

            $products = Product::with('categorie')->get();

            $imges = ProductImage::with('product')->get();
            return view('admin.products.listproduct',compact('products', 'imges'));
        }catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        }  catch (\Exception $e){
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }
    public function add(){
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
            $product = $this->productService->createProduct($request->validated());
            return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create product: ' . $e->getMessage());
            return ApiResponse::error('Failed to create product', 500);
        }
    }

}
