<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\ProductService;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Exceptions\ProductNotFoundException;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        try {
            $products = $this->productService->getProductsByStatus();
           
            return ApiResponse::success($products);
        }catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        }  catch (\Exception $e){
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->productService->createProduct($request->validated());
            return ApiResponse::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create product: ' . $e->getMessage());
            return ApiResponse::error('Failed to create product', 500);
        }
    }

    public function show($id)
    {
        try {
            if (!$id) {
                return ApiResponse::error('ID not provided', 400);
            }
            $product = $this->productService->getProductById($id);
            return ApiResponse::success($product);
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to fetch product: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch product', 500);
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $this->productService->updateProduct($id, $request->validated());
            return ApiResponse::success($product, 'Product updated successfully');
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to update product: ' . $e->getMessage());
            return ApiResponse::error('Failed to update product', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return ApiResponse::success(null, 'Product deleted successfully');
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return ApiResponse::error('Failed to delete product', 500);
        }
    }
    public function getProductByCategory($id) {
        try {
            $data = $this->productService->productByCategory($id);
            return ApiResponse::success($data, 'Product by category fetched successfully');
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }
    public function searchProduct(Request $request){
        try {
            $products = $this->productService->searchProduct($request->all());
            return ApiResponse::success($products, 'Product by category fetched successfully');
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }
    public function getProductTop() {
        return $this->productService->getProductTop();
    }
    public function checkPackageProduct(){
        try{
            $userPackage = Auth::user()->activeUserPackage; 
            return ApiResponse::success($userPackage);
        }catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        }  catch (\Exception $e){
            Log::error('Failed to fetch package: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch package', 500);
        }
    }
}
