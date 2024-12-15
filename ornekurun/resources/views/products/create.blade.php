@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Yeni Ürün Ekle</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Ürün Adı</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" required>
        </div>
        <div class="mb-3">
            <label for="regular_price" class="form-label">Fiyat</label>
            <input type="number" step="0.01" class="form-control" id="regular_price" name="regular_price" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Stok Miktarı</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Kategori Seç</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="published" value="1" id="published">
            <label for="published" class="form-check-label">Yayında</label>
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
</div>
@endsection
