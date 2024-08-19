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
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $brandService;
    protected $userService;
    public function __construct(ProductService $productService, CategoryService $categoryService, BrandService $brandService, UserService $userService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
    }


    // show screen product
    public function store()
    {
        try {
            $products = $this->productService->getAllProducts();
            $category = $this->categoryService->getAllCategories();
            $role =  $this->userService->getUser(request());
            return view('admin.products.listproduct', compact('products', 'category','role'));
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
            $brand = $this->brandService->getAllBrand();
            $role =  $this->userService->getUser(request());
            return view('admin.products.add', compact('category','brand','role'));
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
        $brand = $this->brandService->getAllBrand();

        // dd($product);
        return view('admin.products.edit', compact('product', 'category', 'brand'));
    }
    public function editSubmit(Request $request, $id){
        try {
            $product = $this->productService->updateProduct($id, $request->all());
            return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
            // return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to update product: ' . $e->getMessage());
            return ApiResponse::error('Failed to update product', 500);
        }
    }
    /**
     * hàm xóa sản phẩm
     */
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
            $role =  $this->userService->getUser(request());
            return view('admin.products.listproduct', compact('products','category','role'));

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
            $role =  $this->userService->getUser(request());
                return view('admin.products.listproduct', compact('products','category','role'));

            // return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return ApiResponse::error('Failed to delete product', 500);
        }
    }

    public function deleteImagesProduct($id){
        $productImages = ProductImage::find($id);
        $productImages->delete();
        session()->flash('success', 'Xóa thành công ảnh !');
        return redirect()->back();
    }

    public function Changecategory(Request $request){
        $product_id = $request->productId;
        $product = $this->productService->getProductById($product_id);
        $category = $this->categoryService->findOrFailCategory($request->category);
        $update = $product->update(['category_id' => $request->category]);
        if(!$update){
            return response()->json(['fail' => true]);
        }
        return response()->json(['success' => true, 'data'=> $category->name]);
    }

    public function Changestatus(Request $request){
        $product_id = $request->productId;
        $product = $this->productService->getProductById($product_id);
        $update = $product->update(['status' => $request->status]);
        if(!$update){
            return response()->json(['fail' => true]);
        }
        return response()->json(['success' => true, 'data'=> $request->status]);
    }
    public function updateProductFeatured(Request $request)  {
        $id_product = $request->id_product;
        $status     = $request->status;
        return  $this->productService->updateProductFeatured($id_product, $status);
    }
    /**
     * duyệt sản phẩm  
     */
    public function updateProductApprove(Request $request)  {
        $id_product = $request->id_product;
        $status     = $request->status;
        return  $this->productService->updateProductApprove($id_product, $status);
    }
    
}

