<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
{
    $categories = Category::whereNull('parent_id')->get(); // Sadece ana kategorileri çek
    return view('pages.new-category', compact('categories'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'category_name' => 'required|string|max:255',
        'category_description' => 'required|string',
        'icon' => 'nullable|string',
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'parent_category' => 'nullable|exists:categories,id',
        'active' => 'boolean',
    ]);

    $category = new Category($validated);
    $category->created_by = 1;
    $category->updated_by = 1;
    
    $category->parent_id = $request->parent_category; // Alt kategori desteği
    if ($request->hasFile('image_path')) {
        $category->image_path = $request->file('image_path')->store('categories');
    }
    $category->save();

    return redirect()->route('category.create')->with('success', 'Kategori başarıyla eklendi!');
}
public function index()
{
    $categories = Category::with('parent')->get(); // Alt kategoriler için parent ilişkisi
    return view('pages.categories', compact('categories'));
}
public function edit($id)
{
    $category = Category::findOrFail($id); // ID ile kategoriyi bulur
    return view('pages.edit-category', compact('category'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
        'category_description' => 'nullable|string',
        'icon' => 'nullable|string',
        'image_path' => 'nullable|string',
        'active' => 'required|boolean',
    ]);

    $category = Category::findOrFail($id);
    $category->update($request->all());

    return redirect()->route('categories.index')->with('success', 'Kategori başarıyla güncellendi.');
}

}
