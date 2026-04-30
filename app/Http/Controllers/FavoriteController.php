<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = session()->get('favorites', []);

        return view('favorites', compact('favorites'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $favorites = session()->get('favorites', []);

        if (!isset($favorites[$id])) {
            $favorites[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('favorites', $favorites);

        return redirect()->back()->with('success', 'Producto agregado a favoritos');
    }

    public function remove($id)
    {
        $favorites = session()->get('favorites', []);

        if (isset($favorites[$id])) {
            unset($favorites[$id]);
            session()->put('favorites', $favorites);
        }

        return redirect()->back()->with('success', 'Eliminado de favoritos');
    }
}