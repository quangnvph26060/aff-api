<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;
use GuzzleHttp\Psr7\Request;

class CategoryService
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Hàm lấy ra thông tin của tất cả danh mục
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     * CreatedBy: youngbachhh (27/05/2024)
     */
    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching all categories');
            $categories = $this->category->all();   
            return $categories;
        } catch (Exception $e) {
            Log::error('Failed to fetch categories: ' . $e->getMessage());
            throw new Exception('Failed to fetch categories');
        }
    }

    /**
     * Hàm tạo mới một danh mục
     *
     * @param array $data
     * @return Category
     * @throws ModelNotFoundException
     * CreatedBy: youngbachhh (27/05/2024)
     */
    public function createCategory(array $data): Category
    {
        DB::beginTransaction();
        try {
            Log::info('Creating new category');
            $category = $this->category->create($data);
            DB::commit();
            return $category;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create category: ' . $e->getMessage());
            throw new Exception('Failed to create category');
        }
    }

    /**
     * Hàm cập nhật thông tin của một danh mục
     *
     * @param int $id
     * @param array $data
     * @return Category
     * @throws ModelNotFoundException
     * CreatedBy: youngbachhh (27/05/2024)
     */
    public function updateCategory(int $id, array $data): Category
    {
        DB::beginTransaction();
        try {
            Log::info("Updating category with ID: $id");
            $category = $this->category->findOrFail($id);
            $category->update($data);
            DB::commit();
            return $category;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update category: ' . $e->getMessage());
            throw new Exception('Failed to update category');
        }
    }

    /**
     * Hàm xóa một danh mục
     *
     * @param int $id
     * @throws Exception
     * CreatedBy: youngbachhh (30/05/2024)
     */
    public function deleteCategory(int $id): void
    {
        DB::beginTransaction();
        try {
            Log::info("Deleting category with ID: $id");
            $category = $this->category->findOrFail($id);
            $category->delete();
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            Log::error('Category not found: ' . $e->getMessage());
            throw new ModelNotFoundException('Category not found');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete category: ' . $e->getMessage());
            throw new Exception('Failed to delete category');
        }
    }
     /**
     * Hàm lấy ra  một danh mục (edit)
     *
     * @param array $data
     * @return Category
     * @throws ModelNotFoundException
     */
    public function findOrFailCategory($id)
    {
        try {
            Log::info('Creating new category');
            $category = $this->category->findOrFail($id);

            return $category;
        } catch (Exception $e) {

            Log::error('Failed to find category: ' . $e->getMessage());
            throw new Exception('Failed to find category');
        }
    }
    /***
     * 
     * hàm tìm kiếm danh mục theo name
     */
    public function findCategory($name)  {
        try{
            $category = $this->category->where('name', 'LIKE', '%' . $name . '%')->get();
            if ($category->isEmpty()) {
                throw new Exception('Category not found');
            }
            Log::info($category );
            return $category;
        }catch(\Exception $e){
            Log::error('Failed to find category: ' . $e->getMessage());
            throw new Exception('Failed to find category');
        }
    }
}
