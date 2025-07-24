<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use Illuminate\Http\Request;

use Illuminate\Support\Str;  
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function Product()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    // public function tableProduct() 
    // {
    //     $products = Product::all();

    //     $data = DataTables::of($products)
    //     ->addColumn('no', function ($row) {
    //         static $counter = 0;
    //         return ++$counter;
    //     })
    //     ->addColumn('nama_product', function ($row) {
    //         return $row->nama_Product;
    //     })
    //     ->addColumn('no_telp', function ($row) {
    //         return $row->no_telp;
    //     })
    //     ->addColumn('status', function ($row) {
    //         $status = $row->status == "available" ? " bg-success" : "bg-danger";
    //         return '<span class="badge rounded-pill '.$status.'">'.$row->status.'</span>';
    //     })
    //     ->addColumn('action', function ($row) {
    //         return '
    //         <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-warning edit-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#edit-modal">
    //         <i class="ti ti-pencil"></i>
    //         </button>
    //         <button type="button" class="btn btn-sm waves-effect waves-light btn-danger delete-btn" id="sa-confirm" data-id="'.$row->id.'">
    //         <i class="ti ti-trash"></i>
    //         </button>
    //         ';

    //     })->rawColumns(['action','status'])
    //     ->make(true);

    //     return $data;
    // }

    public function get($id)
    {
        $product = Product::find($id);

        return response()->json($Product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Data deleted successfully.']);
        } else {
            return response()->json(['message' => 'Data not found.'], 404);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
            }

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imagePath ?? null,
            ]);

            return response()->json([
                'message' => 'Product created successfully!',
                'product' => $product
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Product store failed', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Product creation failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $product = Product::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($product->image && \Storage::disk('public')->exists($product->image)) {
                    \Storage::disk('public')->delete($product->image);
                }
                $imagePath = $request->file('image')->store('products', 'public');
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imagePath ?? $product->image,
            ]);

            return response()->json(['message' => 'Product updated successfully!'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Product update failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
