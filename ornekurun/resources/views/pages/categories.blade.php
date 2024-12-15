@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

<header>
   <div class="d-flex justify-content-between mt-3">
    <h1 class="text-3xl font-bold underline">
        Kategoriler
    </h1>
    <a href="/kategoriler/yeni">
        <button type="button" class="btn btn-primary">Yeni Kategori</button>
    </a>
   </div>
</header>


<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Kategori Adı</th>
                <th>Açıklama</th>
                <th>İkon</th>
                <th>Görsel</th>
                <th>Durum</th>
                <th>Alt Kategori</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->category_description }}</td>
                <td><i class="{{ $category->icon }}"></i></td>
                <td>
                    @if($category->image_path)
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="Kategori Görseli" width="50">
                    @else
                        Görsel Yok
                    @endif
                </td>
                <td>
                    @if($category->active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Pasif</span>
                    @endif
                </td>
                <td>
                    {{ $category->parent ? $category->parent->category_name : 'Ana Kategori' }}
                </td>
                <td>
                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm">Düzenle</a>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu kategoriyi silmek istediğinizden emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection