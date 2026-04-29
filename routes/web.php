<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

Route::get('/', function () {
    $search = request('search');

    $products = Product::with('category')
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('brand', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        })
       ->paginate(8);
       
    $categories = Category::all();

    return view('home', compact('products', 'categories', 'search'));
});

Route::get('/categorias/{id}/productos', function ($id) {

    $category = Category::with('products')->findOrFail($id);

    return view('category-products', compact('category'));

})->name('categories.products');

Route::get('/productos/{id}', function ($id) {
    $product = Product::with('category')->findOrFail($id);

    return view('product-detail', compact('product'));
})->name('products.detail');

Route::get('/marcas/{brand}', function ($brand) {
    $products = \App\Models\Product::with('category')
        ->where('brand', $brand)
        ->get();

    return view('brand-products', compact('products', 'brand'));
})->name('brands.products');
Route::get('/admin/login', function () {
    return view('admin-login');  // Muestra la vista del formulario de login
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    if ($request->user === 'admin' && $request->password === '1234') {
        session(['admin_logged' => true]); // Guardar sesión del admin
        return redirect()->route('admin.products'); // Redirigir al panel de administración
    }
    return back()->with('error', 'Usuario o contraseña incorrectos');
})->name('admin.login.submit');
Route::get('/admin/productos', function () {
    if (!session('admin_logged')) {
         return redirect()->route('admin.login');
    }

    $products = Product::with('category')->paginate(7);
    $categories = Category::all();

    return view('admin-products', compact('products', 'categories'));
})->name('admin.products');

Route::post('/admin/productos', function (Request $request) {
    Product::create($request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'brand' => 'required|string',
        'ram' => 'required|string',
        'storage' => 'required|string',
        'operating_system' => 'required|string',
        'image' => 'required|string',
        'category_id' => 'required|exists:categories,id'
    ]));

    return redirect()->route('admin.products')->with('success', 'Producto agregado correctamente');
})->name('admin.products.store');

Route::put('/admin/productos/{id}', function (Request $request, $id) {
    $product = Product::findOrFail($id);

    $product->update($request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'brand' => 'required|string',
        'ram' => 'required|string',
        'storage' => 'required|string',
        'operating_system' => 'required|string',
        'image' => 'required|string',
        'category_id' => 'required|exists:categories,id'
    ]));

    return redirect()->route('admin.products')->with('success', 'Producto actualizado correctamente');
})->name('admin.products.update');

Route::delete('/admin/productos/{id}', function ($id) {
    Product::findOrFail($id)->delete();

    return redirect()->route('admin.products')->with('success', 'Producto eliminado correctamente');
})->name('admin.products.destroy');