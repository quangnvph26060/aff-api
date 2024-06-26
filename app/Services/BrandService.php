<?php
namespace App\Services;

use App\Models\Brand;
use Illuminate\Support\Facades\Log;
use Exception;


class BrandService{

    protected $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function getAllBrand(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching all categories');
            $categories = $this->brand->all();
            return $categories;
        } catch (Exception $e) {
            Log::error('Failed to fetch brand: ' . $e->getMessage());
            throw new Exception('Failed to fetch brand');
        }
    }
}
