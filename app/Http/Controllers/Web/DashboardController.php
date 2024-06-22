<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\OrderService;


use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    protected $orderService;
    protected $categoryService;

    public function __construct(OrderService $orderService, CategoryService $categoryService)
    {
        $this->orderService = $orderService;
        $this->categoryService = $categoryService;
    }
    public function index(){
        $order = $this->orderService->orderNew();
        $category = $this->categoryService->productCategory();
        $bestseller = $this->BestSeller();
        // dd($order[0]);
        return view('admin.dashboard.dashboard', compact('order', 'category','bestseller'));
    }
    public function BestSeller()
    {
        try {
            $data = $this->orderService->getBestSeller();
            // dd($data);
            return $data;
        } catch (\Exception $e) {
            Log::error('Failed to get best seller: ' . $e->getMessage());
            // return view('admin.dashboard.dashboard', ['error' => 'Failed to get best seller']);
            throw new Exception('Failed');
        }

    }


}
