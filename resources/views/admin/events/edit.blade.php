@extends('layouts.admin')

@section('title', 'Etkinliği Düzenle')

@section('content')
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.events.index') }}" 
               class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Etkinliği Düzenle</h1>
                <p class="mt-1 text-sm text-gray-500">Mevcut etkinliği güncelleyin</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <button type="submit" form="event-form" 
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

        <form id="event-form" method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Başlık <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="title"
                       name="title" 
                       value="{{ old('title', $event->title) }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="Etkinlik başlığını girin">
                @error('title')
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
                       value="{{ old('slug', $event->slug) }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                       placeholder="ornek-etkinlik">
                <p class="mt-1 text-xs text-gray-500">URL'de görünecek kısa isim. Boş bırakırsanız otomatik oluşturulur.</p>
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Tarih <span class="text-red-500">*</span>
                </label>
                <input type="datetime-local" 
                       id="event_date"
                       name="event_date" 
                       value="{{ old('event_date', optional($event->event_date)->format('Y-m-d\TH:i')) }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('event_date') border-red-500 @enderror">
                @error('event_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori
                </label>
                <select id="category_id" 
                        name="category_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category_id') border-red-500 @enderror">
                    <option value="">— Yok —</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}" {{ old('category_id', $event->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                    Konum
                </label>
                <input type="text" 
                       id="location"
                       name="location" 
                       value="{{ old('location', $event->location) }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror"
                       placeholder="Etkinlik konumunu girin">
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="media_url" class="block text-sm font-medium text-gray-700 mb-2">
                    Medya URL
                </label>
                <input type="text" 
                       id="media_url"
                       name="media_url" 
                       value="{{ old('media_url', $event->media_url) }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('media_url') border-red-500 @enderror"
                       placeholder="Etkinlik için medya URL'sini girin">
                @error('media_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Açıklama
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="6" 
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Etkinlik açıklamasını girin">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </form>
    </div>
@endsection
