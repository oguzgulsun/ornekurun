<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); // Tüm ürünler ve kategorileri alın
        return view('products.index', compact('products'));
    }
    
    public function create()
    {
        $categories = Category::where('active', 1)->get(); // Sadece aktif kategorileri alın
        return view('products.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:50|unique:products',
            'regular_price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')->with('success', 'Ürün başarıyla eklendi.');
    }
    public function edit($id)
    {
        // Düzenlenecek ürünü ve kategori verilerini al
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Tüm kategorileri al

        // Edit view'ına product ve categories verilerini göndereceğiz
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Verileri doğrulama
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'regular_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'published' => 'nullable|boolean',
        ]);

        // Ürünü bul
        $product = Product::findOrFail($id);

        // Ürünü güncelle
        $product->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'regular_price' => $request->regular_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'published' => $request->has('published') ? 1 : 0, // Eğer "published" checkbox işaretlendiyse 1, değilse 0
        ]);

        // Başarı mesajı ile ürün listeleme sayfasına yönlendir
        return redirect()->route('products.index')->with('success', 'Ürün başarıyla güncellendi!');
    }

    public function filter(Request $request)
    {
        $query = Product::query();

        // Kategori filtresi
        if ($request->has('categories') && !empty($request->categories)) {
            $query->whereIn('category_id', $request->categories);
        }

        // Ürün ismine göre arama
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filtrelenmiş ürünleri al
        $products = $query->with('category')->get();

        // Kategorileri almak
        $categories = Category::all();

        // Filtered ürünler ile birlikte view'ı döndürüyoruz
        return view('products.filter', compact('products', 'categories'));
    }
}
