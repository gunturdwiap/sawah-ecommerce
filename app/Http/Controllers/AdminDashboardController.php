<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totals = [
            'users' => User::count(),
            'products' => Product::count(),
            'categories' => Category::count(),
            'orders' => Order::count()
        ];

        $productsByCategory = Product::with('category')
            ->select('category_id', \DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->get();

        return view('admin.dashboard', [
            'totals' => $totals,
            'productsByCategory' => $productsByCategory
        ]);
    }
}
