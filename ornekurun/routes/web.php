<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/kategoriler/yeni', [CategoryController::class, 'create'])->name('category.create');
Route::post('/kategoriler', [CategoryController::class, 'store'])->name('category.store');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/kategoriler', [CategoryController::class, 'index'])->name('categories.index');

Route::delete('/kategoriler/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/kategoriler/{category}/duzenle', [CategoryController::class, 'edit'])->name('category.edit');

// Route::get('/yeni-kategori', function () {
//     return view('pages.new-category');
// });


Route::get('/urunler', function () {
    return view('pages.products');
});




Route::get('/urunler', [ProductController::class, 'index'])->name('products.index');
Route::get('/urunler/yeni', [ProductController::class, 'create'])->name('products.create');
Route::get('/urunler/{id}/duzenle', [ProductController::class, 'edit'])->name('products.edit');



Route::get('/filtrele', [ProductController::class, 'filter'])->name('products.filter');
