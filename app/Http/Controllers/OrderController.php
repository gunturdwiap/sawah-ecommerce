<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        abort_if($request->user()->is_admin, 403);

        $orders = Auth::user()->orders()->with('product')->latest()->get();
        return view('user.order', compact('orders'));
    }

    public function store(Request $request)
    {
        abort_if($request->user()->is_admin, 403);

        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $user->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        $user->carts()->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat');
    }
}
