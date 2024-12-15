@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Kategori Düzenle</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- PUT metodunu belirtir -->
        
        <div class="mb-3">
            <label for="category_name" class="form-label">Kategori Adı</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
        </div>

        <div class="mb-3">
            <label for="category_description" class="form-label">Kategori Açıklaması</label>
            <textarea class="form-control" id="category_description" name="category_description" rows="3">{{ $category->category_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Kategori İkonu</label>
            <input type="text" class="form-control" id="icon" name="icon" value="{{ $category->icon }}">
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Resim Yolu</label>
            <input type="text" class="form-control" id="image_path" name="image_path" value="{{ $category->image_path }}">
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Aktiflik Durumu</label>
            <select class="form-select" id="active" name="active">
                <option value="1" {{ $category->active ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$category->active ? 'selected' : '' }}>Pasif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>
@endsection
