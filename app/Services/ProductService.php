<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $product;
    protected $userService;
    public function __construct(Product $product, UserService $userService)
    {
        $this->product = $product;
        $this->userService = $userService;
    }

    /**
     * Hàm lấy ra thông tin của tất cả sản phẩm
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     * CreatedBy: youngbachhh (27/05/2024)
     */
    public function getAllProducts()
    {
        try {
            $user = $this->userService->getUser(request());
            if($user['user']['role_id'] === 1 ){
                return $this->product->orderBy('created_at', 'desc')->paginate(10);
            }

            return $this->product->where('brands_id',$user['user']['id'] )->orderBy('created_at', 'desc')->paginate(10);
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to fetch products');
        }
    }

    public function getProductsByStatus(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching all products by published');

            return $this->product->where('status', 'published')->where('quantity','>', 0)->where('approve_product', 1)->get();
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to fetch products');
        }
    }


    /**
     * Hàm lấy ra thông tin của sản phẩm theo id
     *
     * @param int $id
     * @return Product
     * @throws ModelNotFoundException
     * CreatedBy: youngbachhh (27/05/2024)
     */
    public function getProductById(int $id): Product
    {
        Log::info("Fetching product with ID: $id");
        $product = $this->product->find($id);

        if (!$product) {
            Log::warning("Product with ID: $id not found");
            throw new ModelNotFoundException("Product not found");
        }

        return $product;
    }

    /**
     * Hàm tạo mới một sản phẩm
     */
    public function createProduct(array $data): Product
    {
        DB::beginTransaction();

        try {
            // Log::info("Creating a new product with name: {$data['name']}");

            $product = $this->product->create([
                'name' => $data['name'],
                'price' => $data['price'],
                'purchase_price' => $data['purchase_price'],
                'quantity' => $data['quantity'],
                'product_unit' => @$data['product_unit'],
                'category_id' => $data['category_id'],
                'description' => @$data['description'],
                'is_featured' => @$data['is_featured'] ?? 0,
                'is_new_arrival' => @$data['is_new_arrival'],
                'status' =>  $data['status'],
                'reviews' => @$data['reviews'],
                'commission_rate' => @$data['commission_rate'],
                'discount_id' => @$data['discount_id'],
                'brands_id' => @$data['brand_id'],
            ]);
            if ($product) {
                foreach ($data['images'] as $item) {
                    $image = $item;
                    $filename = 'image_' . time() . '_' . $image->getClientOriginalName();
                    $filePath = 'storage/images/' . $filename;
                    Storage::putFileAs('public/images', $image, $filename);
                    $image = new ProductImage();
                    $image->product_id = $product->id;
                    $image->image_path = $filePath;
                    $image->save();
                }
            }
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to create product: {$e->getMessage()}");
            throw new Exception('Failed to create product');
        }
    }

    /**
     * Hàm cập nhật thông tin của sản phẩm
     *
     * @param int $id
     * @param array $data
     * @return Product
     * @throws ModelNotFoundException
     * @throws Exception
     * CreatedBy: youngbachhh (27/05/2024)
     */
    public function updateProduct(int $id, array $data): Product
    {
        $existingImagePaths = ProductImage::where('product_id', $id)->pluck('image_path')->toArray();
        $imageNames = [];
        foreach ($existingImagePaths as $path) {
            $fullFileName = basename($path);
            $pattern = '/image_\d+_(.*)/';
            if (preg_match($pattern, $fullFileName, $matches)) {
                $imageNames[] = $matches[1];
            }
        }

        DB::beginTransaction();
        try {
            $product = $this->getProductById($id);
            Log::info("Updating product with data: " . json_encode($data));

            $update = $product->update($data);
            if ($update) {
                if (isset($data['images'])) {
                    foreach ($data['images'] as $item) {
                        $image = $item;
                        $filename = 'image_' . time() . '_' . $image->getClientOriginalName();
                        $filePath = 'storage/images/' . $filename;
                        if (!in_array($image->getClientOriginalName(), $imageNames)) {
                            Storage::putFileAs('public/images', $image, $filename);
                            $image = new ProductImage();
                            $image->product_id = $product->id;
                            $image->image_path = $filePath;
                            $image->save();
                        }
                    }
                }
            }
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update product: {$e->getMessage()}");
            throw new Exception('Failed to update product');
        }
    }

    /**
     * Hàm xóa một sản phẩm
     *
     * @param int $id
     * @throws ModelNotFoundException
     * @throws Exception
     * CreatedBy: youngbachhh (27/05/2024)
     */
    public function deleteProduct(int $id): void
    {
        DB::beginTransaction();
        try {
            $product = $this->getProductById($id);

            Log::info("Deleting product with ID: $id");
            $product->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete product: {$e->getMessage()}");
            throw new Exception('Failed to delete product');
        }
    }


    public function productByCategory($id)
    {
        try {
            $products = $this->product->where('category_id', $id)->paginate(10);
            return $products;
        } catch (Exception $e) {
            Log::error("Failed to fetch products: {$e->getMessage()}");
            throw new Exception('Failed to fetch products');
        }
    }

    public function productByName($name)
    {
        try {
            $products = $this->product->where('name', 'LIKE', '%' . $name . '%')->paginate(10);
            return $products;
        } catch (Exception $e) {
            Log::error("Failed to search products: {$e->getMessage()}");
            throw new Exception('Failed to search products');
        }
    }
    public function searchProduct($data) {
        try {
            $products = $this->product->where('name',$data['searchValues']['searchQuery'])
                                        ->orwhere('category_id',$data['searchValues']['selectedCategory'])
                                        ->get();
            return $products;
        } catch (Exception $e) {
            Log::error("Failed to search products: {$e->getMessage()}");
            throw new Exception('Failed to search products');
        }
    }
    public function updateProductFeatured($id_product, $status) {
        try {
            $product = $this->product->find($id_product);
            if (!$product) {
                throw new ModelNotFoundException("Find Product to update featured");
            }
            $product->update(['is_featured' => $status]);
        } catch (Exception $e) {
            Log::error("Error updating Product Featured: {$e->getMessage()}");
            throw new Exception('Failed to update Product Featured');
        }
    }
    // duyệt sản phẩm
    public function updateProductApprove($id_product, $status) {
        try {
            $product = $this->product->find($id_product);
            if (!$product) {
                throw new ModelNotFoundException("Find Product to update featured");
            }
            $product->update(['approve_product' => $status]);
        } catch (Exception $e) {
            Log::error("Error updating Product Featured: {$e->getMessage()}");
            throw new Exception('Failed to update Product Featured');
        }
    }
    public function getProductTop () {
        try {
            $product = $this->product->where('is_featured',1)->get();
            if (!$product) {
                throw new ModelNotFoundException("Find Product to update featured");
            }
            return $product;
        } catch (Exception $e) {
            Log::error("Error updating Product Featured: {$e->getMessage()}");
            throw new Exception('Failed to update Product Featured');
        }
    }
}
