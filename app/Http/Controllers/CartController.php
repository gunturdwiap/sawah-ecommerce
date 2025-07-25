<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();
        return view('user.cart', compact('cartItems'));
    }

    public function store(Product $product)
    {
        $cart = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        $cart->quantity = $cart->exists ? $cart->quantity + 1 : 1;
        $cart->save();

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}
