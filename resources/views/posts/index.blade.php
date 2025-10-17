@extends('layouts.app')

@section('title', 'Bloglar')

@section('content')
	{{-- Hero Section - Ultra Modern --}}
	<div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-purple-900 rounded-3xl p-8 md:p-16 mb-12 overflow-hidden">
		{{-- Animated Background Elements --}}
		<div class="absolute inset-0 opacity-20">
			<div class="absolute top-0 right-0 w-96 h-96 bg-blue-500 rounded-full filter blur-[100px] animate-pulse"></div>
			<div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-500 rounded-full filter blur-[100px] animate-pulse" style="animation-delay: 1s;"></div>
			<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-cyan-500 rounded-full filter blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>
		</div>

		{{-- Grid Pattern Overlay --}}
		<div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.03)_1px,transparent_1px)] bg-[size:64px_64px]"></div>
		
		<div class="relative z-10">
			{{-- Category Badge --}}
			<div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full mb-6 shadow-2xl">
				<div class="w-2 h-2 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full animate-pulse"></div>
				<span class="text-sm font-bold text-white">{{ $activeCategory->name ?? 'Tüm Kategoriler' }}</span>
			</div>
			
			{{-- Main Heading --}}
			<h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-4 leading-[1.1]">
				Keşfet & 
				<span class="relative inline-block">
					<span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Öğren</span>
					<svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 5.5C50 1 100 1 199 5.5" stroke="url(#gradient)" stroke-width="3" stroke-linecap="round"/>
						<defs>
							<linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
								<stop offset="0%" style="stop-color:#60a5fa"/>
								<stop offset="50%" style="stop-color:#a78bfa"/>
								<stop offset="100%" style="stop-color:#f472b6"/>
							</linearGradient>
						</defs>
					</svg>
				</span>
			</h1>
			<p class="text-white/80 text-lg md:text-xl max-w-2xl leading-relaxed">
				En güncel içerikler, derinlemesine analizler ve ilham verici hikayeler. Bilgi dünyasına adım atın.
			</p>

			{{-- Quick Stats --}}
			<div class="flex flex-wrap gap-6 mt-8">
				<div class="flex items-center gap-3">
					<div class="w-12 h-12 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl flex items-center justify-center">
						<svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
							<path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
						</svg>
					</div>
					<div>
						<div class="text-2xl font-bold text-white">{{ $posts->total() }}</div>
						<div class="text-sm text-white/60">Toplam Yazı</div>
					</div>
				</div>
				<div class="flex items-center gap-3">
					<div class="w-12 h-12 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl flex items-center justify-center">
						<svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
							<path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
						</svg>
					</div>
					<div>
						<div class="text-2xl font-bold text-white">{{ $categories->count() }}</div>
						<div class="text-sm text-white/60">Kategori</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Filters & Search Bar - Enhanced --}}
	<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-10 backdrop-blur-xl">
		<div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
			{{-- Left: Sort & Category --}}
			<div class="flex flex-wrap items-center gap-3">
				<span class="text-sm font-bold text-gray-900">Filtrele:</span>
				<div class="flex gap-2">
					<a href="?{{ http_build_query(request()->except('sort')) }}" 
					   class="group px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ request('sort') !== 'popular' ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 hover:scale-105' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 hover:scale-105' }}">
						<span class="flex items-center gap-2">
							<svg class="w-4 h-4 {{ request('sort') !== 'popular' ? 'animate-spin-slow' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							En Yeni
						</span>
					</a>
					<a href="?{{ http_build_query(array_merge(request()->except('sort'), ['sort' => 'popular'])) }}" 
					   class="group px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ request('sort') === 'popular' ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 hover:scale-105' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 hover:scale-105' }}">
						<span class="flex items-center gap-2">
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
							</svg>
							Popüler
						</span>
					</a>
				</div>

				<div class="h-8 w-px bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>

				{{-- Category Dropdown --}}
				<div class="relative">
					<select onchange="location=this.value" 
					        class="appearance-none pl-5 pr-12 py-2.5 rounded-xl text-sm font-bold border-2 border-gray-200 bg-white hover:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer transition-all duration-300">
						<option value="?{{ http_build_query(request()->except('category')) }}">📚 Tüm Kategoriler</option>
						@foreach($categories as $c)
							<option value="?{{ http_build_query(array_merge(request()->except('category'), ['category'=>$c->id])) }}" 
							        {{ request('category')==$c->id ? 'selected' : '' }}>
								{{ $c->name }}
							</option>
						@endforeach
					</select>
					<svg class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
					</svg>
				</div>
			</div>

			{{-- Right: Search --}}
			<form method="GET" class="w-full lg:w-96">
				<div class="relative group">
					<input type="search" 
					       name="q" 
					       value="{{ request('q') }}" 
					       placeholder="Yazı ara..." 
					       class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-sm font-medium">
					<svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 group-focus-within:text-blue-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
					</svg>
				</div>
			</form>
		</div>
	</div>

	{{-- Main Content Grid --}}
	<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
		{{-- Posts Grid --}}
		<div class="lg:col-span-3">
			<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
				@forelse($posts as $post)
					@php $img = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
					<article class="group bg-white rounded-2xl overflow-hidden border-2 border-gray-100 hover:border-blue-500 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
						{{-- Image with Overlay --}}
						<a href="{{ route('posts.show', $post) }}" class="block relative h-52 overflow-hidden">
							@if($img)
								<img src="{{ $img->url }}" 
								     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:rotate-2" 
								     alt="{{ $img->alt }}">
							@else
								<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100">
									<svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
									</svg>
								</div>
							@endif
							
							{{-- Gradient Overlay --}}
							<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
							
							{{-- Category Badge --}}
							@if($post->categories->isNotEmpty())
								<div class="absolute top-4 left-4 z-10">
									<span class="inline-flex items-center gap-2 px-4 py-2 bg-white/95 backdrop-blur-sm text-gray-900 text-xs font-black rounded-full shadow-xl group-hover:scale-110 transition-transform duration-300">
										<span class="w-2 h-2 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full animate-pulse"></span>
										{{ $post->categories->first()->name }}
									</span>
								</div>
							@endif

							{{-- Read More Indicator --}}
							<div class="absolute bottom-4 right-4 w-12 h-12 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 shadow-xl">
								<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
								</svg>
							</div>
						</a>

						{{-- Content --}}
						<div class="p-6">
							<a href="{{ route('posts.show', $post) }}" class="block">
								<h3 class="text-xl font-black text-gray-900 mb-3 line-clamp-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 group-hover:bg-clip-text transition-all duration-300 leading-tight">
									{{ $post->title }}
								</h3>
							</a>
							<p class="text-gray-600 text-sm line-clamp-3 mb-5 leading-relaxed">
								{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
							</p>

							{{-- Meta Info --}}
							<div class="flex items-center justify-between pt-5 border-t-2 border-gray-100">
								<div class="flex items-center gap-2 text-xs font-bold text-gray-500">
									<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
									</svg>
									<span>{{ $post->published_at?->format('d M Y') }}</span>
								</div>
								@if(isset($post->reading_time))
									<div class="flex items-center gap-2 text-xs font-bold text-gray-500">
										<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
										</svg>
										<span>{{ $post->reading_time }} dk</span>
									</div>
								@endif
							</div>

							{{-- Engagement Stats --}}
							<div class="flex items-center gap-3 mt-4">
								<div class="flex items-center gap-2 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-2 rounded-xl border border-emerald-200 transition-all hover:bg-emerald-100">
									<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
										<path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
									</svg>
									<span>{{ $post->likes_count ?? 0 }}</span>
								</div>
								<div class="flex items-center gap-2 text-xs font-bold text-rose-700 bg-rose-50 px-3 py-2 rounded-xl border border-rose-200 transition-all hover:bg-rose-100">
									<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
										<path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
									</svg>
									<span>{{ $post->dislikes_count ?? 0 }}</span>
								</div>
							</div>

						</div>
					</article>
				@empty
					<div class="col-span-full">
						<div class="text-center py-20 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 rounded-3xl border-2 border-dashed border-gray-300 relative overflow-hidden">
							<div class="absolute inset-0 bg-[linear-gradient(rgba(59,130,246,.03)_1px,transparent_1px),linear-gradient(90deg,rgba(59,130,246,.03)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
							<div class="relative z-10">
								<div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
									<svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
									</svg>
								</div>
								<h3 class="text-2xl font-black text-gray-900 mb-2">Henüz İçerik Yok</h3>
								<p class="text-gray-600 text-base">Yakında yeni ve heyecan verici içerikler eklenecek.</p>
							</div>
						</div>
					</div>
				@endforelse
			</div>

			{{-- Pagination --}}
			<div class="mt-12">
				{{ $posts->links() }}
			</div>
		</div>

		{{-- Sidebar --}}
		<aside class="space-y-6">
			{{-- Categories Widget --}}
			@if($categories->count())
				<div class="bg-white rounded-2xl p-6 border-2 border-gray-100 shadow-xl sticky top-6">
					<div class="flex items-center gap-3 mb-6">
						<div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
							<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
								<path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
							</svg>
						</div>
						<h3 class="text-xl font-black text-gray-900">Kategoriler</h3>
					</div>
					<div class="space-y-2">
						@foreach($categories as $cat)
							<a href="?{{ http_build_query(array_merge(request()->except('category'), ['category' => $cat->id])) }}" 
							   class="flex items-center justify-between p-4 rounded-xl hover:bg-gray-50 transition-all duration-300 group border-2 {{ request('category') == $cat->id ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-blue-500 shadow-lg' : 'border-transparent hover:border-gray-200' }}">
								<span class="text-sm font-bold {{ request('category') == $cat->id ? 'text-blue-700' : 'text-gray-700 group-hover:text-gray-900' }}">
									{{ $cat->name }}
								</span>
								<span class="flex items-center justify-center min-w-[32px] h-8 px-3 {{ request('category') == $cat->id ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 'bg-gray-100 text-gray-600 group-hover:bg-gray-200' }} rounded-full text-xs font-black transition-all duration-300">
									{{ $cat->posts_count }}
								</span>
							</a>
						@endforeach
					</div>
				</div>
			@endif

			{{-- Popular Tags --}}
			<div class="bg-gradient-to-br from-slate-900 via-blue-900 to-purple-900 rounded-2xl p-6 border-2 border-blue-500/20 shadow-xl relative overflow-hidden">
				<div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.03)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
				<div class="relative z-10">
					<h3 class="text-lg font-black text-white mb-5 flex items-center gap-2">
						<span class="w-2 h-2 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full animate-pulse"></span>
						Popüler Etiketler
					</h3>
					<div class="flex flex-wrap gap-2">
						<span class="px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-xs font-bold text-white hover:bg-white/20 hover:scale-105 cursor-pointer transition-all duration-300">#teknoloji</span>
						<span class="px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-xs font-bold text-white hover:bg-white/20 hover:scale-105 cursor-pointer transition-all duration-300">#yazılım</span>
						<span class="px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-xs font-bold text-white hover:bg-white/20 hover:scale-105 cursor-pointer transition-all duration-300">#tasarım</span>
						<span class="px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-xs font-bold text-white hover:bg-white/20 hover:scale-105 cursor-pointer transition-all duration-300">#pazarlama</span>
						<span class="px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-xs font-bold text-white hover:bg-white/20 hover:scale-105 cursor-pointer transition-all duration-300">#yapay-zeka</span>
					</div>
				</div>
			</div>
		</aside>
	</div>

	<style>
		@keyframes spin-slow {
			from { transform: rotate(0deg); }
			to { transform: rotate(360deg); }
		}
		.animate-spin-slow {
			animation: spin-slow 3s linear infinite;
		}
	</style>
@endsection