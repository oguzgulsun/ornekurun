@extends('layouts.app')

@section('title', 'Kategori Ekle')

@section('content')
<div class="container mt-4">
    <h2>Kategori Ekle</h2>
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Laravel'de CSRF koruması için gerekli -->
        
        <!-- Kategori Adı -->
        <div class="mb-3">
            <label for="category_name" class="form-label">Kategori Adı</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Kategori adını girin" required>
        </div>

        <!-- Kategori Açıklaması -->
        <div class="mb-3">
            <label for="category_description" class="form-label">Kategori Açıklaması</label>
            <textarea class="form-control" id="category_description" name="category_description" rows="3" placeholder="Kategori açıklamasını girin" required></textarea>
        </div>

        <!-- İkon -->
        <div class="mb-3">
            <label for="icon" class="form-label">İkon (HTML veya Unicode)</label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="İkon kodunu girin (örn: fa fa-home)">
        </div>

        <!-- Görsel Yükleme -->
        <div class="mb-3">
            <label for="image_path" class="form-label">Kategori Görseli</label>
            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
        </div>

        <!-- Alt Kategori Seçimi -->
        <div class="mb-3">
            <label for="parent_category" class="form-label">Ana Kategori (Alt kategori için)</label>
            <select class="form-select" id="parent_category" name="parent_category">
                <option value="">Ana kategori olarak ekle</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Aktiflik -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="active" name="active" checked>
            <label class="form-check-label" for="active">
                Aktif
            </label>
        </div>

        <!-- Oluşturan Kullanıcı -->
        <input type="hidden" name="created_by" value="{{ auth()->id() }}">

        <!-- Submit Butonu -->
        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
</div>
@endsection
