@extends('layouts.admin')

@section('title', 'Yeni Fotoğraf Ekle')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900">Yeni Fotoğraf Ekle</h1>
        <p class="text-gray-600 mt-2">Galeriye yeni bir fotoğraf ekleyin</p>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data" class="p-8">
            @csrf

            {{-- Image Type Selection --}}
            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-4">Resim Kaynağı</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="image_type" value="upload" class="sr-only" checked>
                        <div class="p-6 border-2 border-gray-200 rounded-2xl hover:border-blue-500 transition-colors image-type-option" data-type="upload">
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
                        <input type="radio" name="image_type" value="url" class="sr-only">
                        <div class="p-6 border-2 border-gray-200 rounded-2xl hover:border-blue-500 transition-colors image-type-option" data-type="url">
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
            <div id="upload-fields" class="space-y-6">
                {{-- Image Upload --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Resim Dosyası *</label>
                    <div class="relative">
                        <input type="file" name="image_file" accept="image/*" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Maksimum 10MB, JPG, PNG, GIF formatları desteklenir</p>
                </div>

                {{-- Thumbnail Upload --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Thumbnail (Opsiyonel)</label>
                    <div class="relative">
                        <input type="file" name="thumbnail_file" accept="image/*" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Maksimum 5MB, küçük boyutlu resim önerilir</p>
                </div>
            </div>

            {{-- URL Fields --}}
            <div id="url-fields" class="space-y-6 hidden">
                {{-- Image URL --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Resim URL'i *</label>
                    <input type="url" name="image_url" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="https://example.com/image.jpg">
                </div>

                {{-- Thumbnail URL --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Thumbnail URL (Opsiyonel)</label>
                    <input type="url" name="thumbnail_url" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="https://example.com/thumbnail.jpg">
                </div>
            </div>

            {{-- Basic Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                {{-- Title --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Başlık <span class="text-gray-500 font-normal">(Opsiyonel)</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sort Order --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sıralama</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="0">
                </div>

                {{-- Alt Text --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alt Metin</label>
                    <input type="text" name="alt_text" value="{{ old('alt_text') }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="Resim için açıklayıcı metin">
                </div>
            </div>

            {{-- Description --}}
            <div class="mt-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Açıklama</label>
                <textarea name="description" rows="4" 
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                          placeholder="Fotoğraf hakkında detaylı açıklama">{{ old('description') }}</textarea>
            </div>

            {{-- Settings --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                {{-- Status --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Durum</label>
                    <select name="status" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Yayında</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Taslak</option>
                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Arşiv</option>
                    </select>
                </div>

                {{-- Featured --}}
                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-3 text-sm font-bold text-gray-700">Öne Çıkan Fotoğraf</span>
                    </label>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.galleries.index') }}" 
                   class="px-6 py-3 text-gray-700 font-bold border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-all duration-300">
                    İptal
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                    Fotoğrafı Kaydet
                </button>
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
            // Update visual selection
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

    // Initialize
    toggleFields();
});
</script>
@endsection
