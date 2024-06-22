<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\OrderService;
use Illuminate\Http\Request;

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
        // dd($order[0]);
        return view('admin.dashboard.dashboard', compact('order', 'category'));
    }
}
