<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            // TODO
            'orders' => 0
        ];

        // $productsCount = Product::groupBy()


        return view('admin.dashboard', [
            'totals' => $totals,
        ]);
    }
}
