@extends('layouts.app')

@section('content')


<header>
    <div class="d-flex justify-content-between mt-3">
     <h1 class="text-3xl font-bold underline">
         Ürünler
     </h1>
     <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
         <button type="button" class="btn btn-primary">Yeni Ürün Ekle</button>
     </a>
    </div>
 </header>

 
<div class="container mt-5">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Ad</th>
                <th>SKU</th>
                <th>Fiyat</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->regular_price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category->category_name ?? 'Kategori Yok' }}</td>
                <td>{{ $product->published ? 'Yayında' : 'Taslak' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Düzenle</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
