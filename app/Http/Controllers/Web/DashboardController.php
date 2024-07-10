<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\OrderService;
use App\Services\UserService;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    protected $orderService;
    protected $categoryService;
    protected $userService;

    public function __construct(OrderService $orderService, CategoryService $categoryService, UserService $userService)
    {
        $this->orderService = $orderService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }
    public function index(Request $request){
        $getMonth = $this->orderService->getMonthlyRevenue();
        $getMonthlyRevenue = $getMonth['monthlyRevenue'];
        $totalAnnualRevenue = $getMonth['totalAnnualRevenue'];
        $order = $this->orderService->orderNew();
        $category = $this->categoryService->productCategory();
        $bestseller = $this->BestSeller();
        $useramount = $this->userService->countAllUser();
        $useramountAffliate = $this->userService->countAllUserAffliate();
        $orderamount = $this->orderService->getOrderAmount();
        $statistic = $orderamount -> map(function($amount){
            return[
                'number' => $amount->number,
                'total' => $amount->total,
            ];
        })->first();
        if ($request->session()->has('authUser')) {
            $loggedInUser = $request->session()->get('authUser');

        }
        // dd($loggedInUser);
        return view('admin.dashboard.dashboard', compact('order', 'category','bestseller', 'statistic', 'useramount','loggedInUser', 'getMonthlyRevenue', 'totalAnnualRevenue','useramountAffliate'));
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
