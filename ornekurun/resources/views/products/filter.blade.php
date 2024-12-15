@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ürün Filtreleme</h1>

    <form action="{{ route('products.filter') }}" method="GET">
        @csrf

        <!-- Kategori Seçimi -->
        <div class="mb-3">
            <label for="categories" class="form-label">Kategori Seç</label>
            <select name="categories[]" id="categories" class="form-select" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, request()->categories ?? []) ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Ürün İsmi Arama -->
        <div class="mb-3">
            <label for="name" class="form-label">Ürün Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request()->name }}">
        </div>

        <!-- Filtreleme Butonu -->
        <button type="submit" class="btn btn-primary">Filtrele</button>
    </form>

    <hr>

    <!-- Ürün Listesi -->
    <h2>Filtrelenmiş Ürünler</h2>
    @if($products->isEmpty())
        <p>Hiç ürün bulunamadı.</p>
    @else
        <ul class="list-group">
            @foreach($products as $product)
                <li class="list-group-item">
                    <strong>{{ $product->name }}</strong><br>
                    <small>SKU: {{ $product->sku }}</small><br>
                    <small>Fiyat: {{ $product->regular_price }} TL</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
