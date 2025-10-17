@extends('layouts.admin')

@section('title', 'Fotoğraf Düzenle')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900">Fotoğraf Düzenle</h1>
        <p class="text-gray-600 mt-2">{{ $gallery->title }}</p>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            {{-- Current Image Preview --}}
            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-4">Mevcut Resim</label>
                <div class="relative max-w-md">
                    <img src="{{ $gallery->image }}" alt="{{ $gallery->alt_text ?: $gallery->title }}"
                         class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    <div class="absolute top-2 right-2">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-gray-900 text-xs font-bold rounded-full">
                            {{ $gallery->image_type === 'url' ? 'URL' : 'Yüklenen' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Image Type Selection --}}
            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-4">Resim Kaynağı</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="image_type" value="upload" class="sr-only" {{ $gallery->image_type === 'upload' ? 'checked' : '' }}>
                        <div class="p-6 border-2 {{ $gallery->image_type === 'upload' ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }} rounded-2xl hover:border-blue-500 transition-colors image-type-option" data-type="upload">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <h3 class="font-bold text-gray-900">Dosya Yükle</h3>
                                <p class="text-sm text-gray-600">Bilgisayarınızdan resim seçin</p>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="image_type" value="url" class="sr-only" {{ $gallery->image_type === 'url' ? 'checked' : '' }}>
                        <div class="p-6 border-2 {{ $gallery->image_type === 'url' ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }} rounded-2xl hover:border-blue-500 transition-colors image-type-option" data-type="url">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                <h3 class="font-bold text-gray-900">URL Kullan</h3>
                                <p class="text-sm text-gray-600">Dış kaynaktan resim URL'i</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Upload Fields --}}
            <div id="upload-fields" class="space-y-6 {{ $gallery->image_type === 'url' ? 'hidden' : '' }}">
                {{-- Image Upload --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Yeni Resim Dosyası</label>
                    <div class="relative">
                        <input type="file" name="image_file" accept="image/*" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Maksimum 10MB, JPG, PNG, GIF formatları desteklenir</p>
                </div>

                {{-- Thumbnail Upload --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Yeni Thumbnail</label>
                    <div class="relative">
                        <input type="file" name="thumbnail_file" accept="image/*" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Maksimum 5MB, küçük boyutlu resim önerilir</p>
                </div>
            </div>

            {{-- URL Fields --}}
            <div id="url-fields" class="space-y-6 {{ $gallery->image_type === 'upload' ? 'hidden' : '' }}">
                {{-- Image URL --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Resim URL'i *</label>
                    <input type="url" name="image_url" value="{{ old('image_url', $gallery->image_url) }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="https://example.com/image.jpg">
                </div>

                {{-- Thumbnail URL --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Thumbnail URL</label>
                    <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url', $gallery->thumbnail_url) }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="https://example.com/thumbnail.jpg">
                </div>
            </div>

            {{-- Basic Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                {{-- Title --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Başlık <span class="text-gray-500 font-normal">(Opsiyonel)</span></label>
                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="Fotoğraf başlığı (boş bırakabilirsiniz)">
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Kategori Seçin</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $gallery->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sort Order --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sıralama</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" min="0"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="0">
                </div>

                {{-- Alt Text --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alt Metin</label>
                    <input type="text" name="alt_text" value="{{ old('alt_text', $gallery->alt_text) }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="Resim için açıklayıcı metin">
                </div>
            </div>

            {{-- Description --}}
            <div class="mt-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Açıklama</label>
                <textarea name="description" rows="4" 
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                          placeholder="Fotoğraf hakkında detaylı açıklama">{{ old('description', $gallery->description) }}</textarea>
            </div>

            {{-- Settings --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                {{-- Status --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Durum</label>
                    <select name="status" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="1" {{ old('status', $gallery->status) == 1 ? 'selected' : '' }}>Yayında</option>
                        <option value="0" {{ old('status', $gallery->status) == 0 ? 'selected' : '' }}>Taslak</option>
                        <option value="2" {{ old('status', $gallery->status) == 2 ? 'selected' : '' }}>Arşiv</option>
                    </select>
                </div>

                {{-- Featured --}}
                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-3 text-sm font-bold text-gray-700">Öne Çıkan Fotoğraf</span>
                    </label>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('galleries.show', $gallery) }}" 
                   class="inline-flex items-center px-4 py-2 text-gray-700 font-bold border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Önizle
                </a>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.galleries.index') }}" 
                       class="px-6 py-3 text-gray-700 font-bold border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-all duration-300">
                        İptal
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        Değişiklikleri Kaydet
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageTypeOptions = document.querySelectorAll('input[name="image_type"]');
    const uploadFields = document.getElementById('upload-fields');
    const urlFields = document.getElementById('url-fields');

    function toggleFields() {
        const selectedType = document.querySelector('input[name="image_type"]:checked').value;
        
        if (selectedType === 'upload') {
            uploadFields.classList.remove('hidden');
            urlFields.classList.add('hidden');
        } else {
            uploadFields.classList.add('hidden');
            urlFields.classList.remove('hidden');
        }
    }

    imageTypeOptions.forEach(option => {
        option.addEventListener('change', function() {
            document.querySelectorAll('.image-type-option').forEach(div => {
                div.classList.remove('border-blue-500', 'bg-blue-50');
                div.classList.add('border-gray-200');
            });
            
            const selectedDiv = document.querySelector(`[data-type="${this.value}"]`);
            selectedDiv.classList.add('border-blue-500', 'bg-blue-50');
            selectedDiv.classList.remove('border-gray-200');
            
            toggleFields();
        });
    });

    toggleFields();
});
</script>
@endsection
