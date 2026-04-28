<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'brand' => 'required|string',
            'ram' => 'required|string',
            'storage' => 'required|string',
            'operating_system' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Product::create($validated);


        return response()->json([
            'message' => 'Producto creado',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->find($id);

        if(!$product){
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'brand' => 'required|string',
            'ram' => 'required|string',
            'storage' => 'required|string',
            'operating_system' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Producto actualizado',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado'
        ]);
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    $products = Product::with('category')
        ->where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
              ->orWhere('brand', 'like', "%$query%")
              ->orWhere('description', 'like', "%$query%");
        })
        ->paginate(10);

    return response()->json($products);
}
}
