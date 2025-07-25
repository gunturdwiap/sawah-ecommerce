<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    // public function index()
    // {
    //     $products = Product::all();
    //     return view('dashboard', compact('products'));
    // }

    public function index(Request $request)
    {
         $products = Product::query()
            ->when($request->filled('q'), function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->string('q').'%');
            })
            ->paginate(15);
            return view('admin.product.index', [
                'products' => $products
            ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', ['categories' => $category]);
    }

    public function edit(Product $product)
    {

        $category = Category::all();
        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $category
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name' => ['required','string','max:100'],
            'price' => ['required','numeric','min:0'],
            'description' => ['required','string','max:1000'],
            'category_id' => ['required','numeric','exists:categories,id'],
            'image' => ['required','image','mimes:jpg,jpeg,png,webp','max:2048']
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $attributes['image'] = $imagePath;
        }
        Product::create($attributes);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product)
    {

        $attributes = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
            'category_id' => 'required|numeric|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $attributes['image'] = $imagePath;
        } else {
            $attributes['image'] = $product->image;
        }
        $product->update($attributes);

        // dd($product);
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
        }

}
