<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Bank;
use App\Models\Brand;
use App\Models\Config;
use App\Services\BrandService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    protected $brand;
    public function __construct(BrandService $brand)
    {
        $this->brand = $brand;

    }
    public function imageBrand() {
        return $this->brand->imageBrand();
    }
    public function getBank() {
        $data = Bank::all();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No banks found', 'status' => 'error'], 404);
        }
        return response()->json(['data' => $data, 'status' => 'success']);
    }
    public function getConfig()
    {
        try {
          $data =  Config::first() ?? "";
          return ApiResponse::success($data,'Config success!',200);
        } catch (Exception $e) {
            Log::error('Failed to fetch configuration: ' . $e->getMessage());
            throw new Exception('Failed to fetch configuration');
        }
    }
}
