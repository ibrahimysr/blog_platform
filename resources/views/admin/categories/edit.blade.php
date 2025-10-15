@extends('layouts.admin')

@section('title', 'Kategoriyi Düzenle')

@section('content')
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.categories.index') }}" 
               class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kategoriyi Düzenle</h1>
                <p class="mt-1 text-sm text-gray-500">Mevcut blog kategorisini güncelleyin</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <button type="submit" form="category-form" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm">
                <svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Güncelle
            </button>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        @if ($errors->any())
            <div class="bg-red-50 text-red-800 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="category-form" method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Ad <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name"
                       name="name" 
                       value="{{ old('name', $category->name) }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                       placeholder="Kategori adını girin">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                    Slug
                </label>
                <input type="text" 
                       id="slug"
                       name="slug" 
                       value="{{ old('slug', $category->slug) }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                       placeholder="ornek-kategori">
                <p class="mt-1 text-xs text-gray-500">URL'de görünecek kısa isim. Boş bırakırsanız otomatik oluşturulur.</p>
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Üst Kategori
                </label>
                <select id="parent_id" 
                        name="parent_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('parent_id') border-red-500 @enderror">
                    <option value="">— Yok —</option>
                    @foreach ($parents as $p)
                        <option value="{{ $p->id }}" {{ old('parent_id', $category->parent_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Açıklama
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="4" 
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Kategori açıklamasını girin">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </form>
    </div>
@endsection
