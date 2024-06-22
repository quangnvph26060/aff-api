<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index()
    {
        $bestseller = $this->BestSeller();
        // dd($bestseller);
        return view('admin.dashboard.dashboard', compact('bestseller'));
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
