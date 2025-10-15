@extends('layouts.admin')

@section('title', $post->title)

@section('content')
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.posts.index') }}" 
               class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ $post->slug }} • Durum: {{ ['Taslak', 'Yayınlandı', 'Arşivlendi'][$post->status] ?? 'Bilinmeyen' }} • {{ optional($post->published_at)->format('d M Y H:i') ?? 'Yayınlanmamış' }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.posts.edit', $post) }}" 
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm">
                <svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Düzenle
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Main Content -->
        <div class="col-span-12 lg:col-span-8 space-y-6">
            <!-- Content Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">İçerik</h2>
                <div class="prose prose-sm max-w-none text-gray-700">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Media Card -->
            @if ($post->media->count())
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Medya Dosyaları</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($post->media as $m)
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <div class="text-xs font-medium text-gray-700 mb-2">
                                    {{ ['Görsel', 'Video', 'Diğer'][$m->type] ?? 'Medya' }}
                                    @if ($m->is_primary)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                            Kapak
                                        </span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-600 truncate" title="{{ $m->url }}">
                                    {{ $m->url }}
                                </div>
                                @if ($m->alt)
                                    <div class="text-xs text-gray-500 mt-1">Alt: {{ $m->alt }}</div>
                                @endif
                                @if ($m->caption)
                                    <div class="text-xs text-gray-500 mt-1">Açıklama: {{ $m->caption }}</div>
                                @endif
                                <div class="text-xs text-gray-500 mt-1">Sıra: {{ $m->sort_order }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-500">Henüz medya eklenmedi</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            <!-- Post Details -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-4">Yazı Detayları</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Özet</label>
                        <p class="text-sm text-gray-600">{{ $post->excerpt ?: 'Özet belirtilmemiş' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Okuma Süresi</label>
                        <p class="text-sm text-gray-600">{{ $post->reading_time ? $post->reading_time . ' dakika' : 'Belirtilmemiş' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Kategoriler</label>
                        @if ($post->categories->count())
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach ($post->categories as $category)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-600">Kategori yok</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- SEO Preview -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-4">SEO Önizleme</h3>
                <div class="space-y-2">
                    <div class="text-sm text-blue-600 truncate" id="seo-url">
                        {{ url('/blog/') }}/{{ $post->slug ?: 'ornek-yazi' }}
                    </div>
                    <div class="text-base font-medium text-gray-900" id="seo-title">
                        {{ $post->title ?: 'Yazı Başlığı' }}
                    </div>
                    <div class="text-sm text-gray-600 line-clamp-2" id="seo-desc">
                        {{ $post->excerpt ?: 'Yazı özeti buraya gelecek...' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
