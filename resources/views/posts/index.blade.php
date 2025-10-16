@extends('layouts.app')

@section('title', 'Bloglar')

@section('content')
	{{-- Hero Section with Category --}}
	<div class="relative bg-gradient-to-br from-gray-50 via-white to-blue-50 rounded-3xl p-8 md:p-12 mb-12 overflow-hidden">
		<div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-30 -mr-32 -mt-32"></div>
		<div class="absolute bottom-0 left-0 w-48 h-48 bg-purple-100 rounded-full filter blur-3xl opacity-30 -ml-24 -mb-24"></div>
		
		<div class="relative">
			<div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm mb-4">
				<svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
					<path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
				</svg>
				<span class="text-sm font-semibold text-gray-700">{{ $activeCategory->name ?? 'Tüm Kategoriler' }}</span>
			</div>
			
			<h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-3 leading-tight">
				Keşfet & <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Öğren</span>
			</h1>
			<p class="text-gray-600 text-lg max-w-2xl">En güncel makaleler, derinlemesine analizler ve ilham verici içerikler burada.</p>
		</div>
	</div>

	{{-- Filters & Search Bar --}}
	<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-10">
		<div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
			{{-- Left: Sort & Category --}}
			<div class="flex flex-wrap items-center gap-3">
				<span class="text-sm font-medium text-gray-500">Sırala:</span>
				<div class="flex gap-2">
					<a href="?{{ http_build_query(request()->except('sort')) }}" 
					   class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request('sort') !== 'popular' ? 'bg-gray-900 text-white shadow-lg shadow-gray-900/20' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
						<span class="flex items-center gap-2">
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							En Yeni
						</span>
					</a>
					<a href="?{{ http_build_query(array_merge(request()->except('sort'), ['sort' => 'popular'])) }}" 
					   class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request('sort') === 'popular' ? 'bg-gray-900 text-white shadow-lg shadow-gray-900/20' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
						<span class="flex items-center gap-2">
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
							</svg>
							Popüler
						</span>
					</a>
				</div>

				<div class="h-6 w-px bg-gray-200"></div>

				{{-- Category Dropdown --}}
				<div class="relative">
					<select onchange="location=this.value" 
					        class="appearance-none pl-4 pr-10 py-2 rounded-xl text-sm font-medium border border-gray-200 bg-white hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent cursor-pointer transition-all">
						<option value="?{{ http_build_query(request()->except('category')) }}">📁 Tüm Kategoriler</option>
						@foreach($categories as $c)
							<option value="?{{ http_build_query(array_merge(request()->except('category'), ['category'=>$c->id])) }}" 
							        {{ request('category')==$c->id ? 'selected' : '' }}>
								{{ $c->name }}
							</option>
						@endforeach
					</select>
					<svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
					       class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm">
					<svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
					<article class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-xl transition-all duration-300">
						{{-- Image --}}
						<a href="{{ route('posts.show', $post) }}" class="block relative h-48 overflow-hidden bg-gradient-to-br from-blue-50 to-purple-50">
							@if($img)
								<img src="{{ $img->url }}" 
								     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
								     alt="{{ $img->alt }}">
							@else
								<div class="w-full h-full flex items-center justify-center">
									<svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
									</svg>
								</div>
							@endif
							<div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
							
							{{-- Category Badge --}}
							@if($post->categories->isNotEmpty())
								<div class="absolute top-3 left-3">
									<span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/95 backdrop-blur-sm text-gray-900 text-xs font-bold rounded-full shadow-lg">
										<span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
										{{ $post->categories->first()->name }}
									</span>
								</div>
							@endif
						</a>

						{{-- Content --}}
						<div class="p-5">
							<a href="{{ route('posts.show', $post) }}" class="block">
								<h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors leading-tight">
									{{ $post->title }}
								</h3>
							</a>
							<p class="text-gray-600 text-sm line-clamp-2 mb-4 leading-relaxed">
								{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
							</p>

							{{-- Meta Info --}}
						<div class="flex items-center justify-between pt-4 border-t border-gray-100">
								<div class="flex items-center gap-2 text-xs text-gray-500">
									<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
									</svg>
									<span>{{ $post->published_at?->format('d M Y') }}</span>
								</div>
							@if(isset($post->reading_time))
								<div class="flex items-center gap-1.5 text-xs text-gray-500">
									<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
									</svg>
									<span>{{ $post->reading_time }} dk</span>
								</div>
							@endif

							<div class="flex items-center gap-3">
								<div class="flex items-center gap-1.5 text-xs text-green-700 bg-green-50 px-2 py-1 rounded">
									<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/></svg>
									<span>{{ $post->likes_count ?? 0 }}</span>
								</div>
								<div class="flex items-center gap-1.5 text-xs text-red-700 bg-red-50 px-2 py-1 rounded">
									<svg class="w-3.5 h-3.5 rotate-180" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/></svg>
									<span>{{ $post->dislikes_count ?? 0 }}</span>
								</div>
							</div>
							</div>

							{{-- Author (Optional) --}}
							@if($post->user)
								<div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
									<div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
										{{ substr($post->user->name, 0, 1) }}
									</div>
									<span class="text-xs text-gray-600 font-medium">{{ $post->user->name }}</span>
								</div>
							@endif
						</div>
					</article>
				@empty
					<div class="col-span-full">
						<div class="text-center py-16 bg-gradient-to-br from-gray-50 to-blue-50 rounded-3xl border-2 border-dashed border-gray-200">
							<svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
							</svg>
							<h3 class="text-lg font-bold text-gray-900 mb-1">Henüz içerik yok</h3>
							<p class="text-gray-500 text-sm">Yakında yeni bloglar eklenecek.</p>
						</div>
					</div>
				@endforelse
			</div>

			{{-- Pagination --}}
			<div class="mt-10">
				{{ $posts->links() }}
			</div>
		</div>

		{{-- Sidebar --}}
		<aside class="space-y-6">
			{{-- Categories Widget --}}
			@if($categories->count())
				<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
					<div class="flex items-center gap-2 mb-5">
						<div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
							<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
								<path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
							</svg>
						</div>
						<h3 class="text-lg font-bold text-gray-900">Kategoriler</h3>
					</div>
					<div class="space-y-1.5">
						@foreach($categories as $cat)
							<a href="?{{ http_build_query(array_merge(request()->except('category'), ['category' => $cat->id])) }}" 
							   class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-all group {{ request('category') == $cat->id ? 'bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-100' : '' }}">
								<span class="text-sm font-medium {{ request('category') == $cat->id ? 'text-blue-700' : 'text-gray-700 group-hover:text-gray-900' }}">
									{{ $cat->name }}
								</span>
								<span class="flex items-center justify-center min-w-[28px] h-7 px-2.5 {{ request('category') == $cat->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 group-hover:bg-gray-200' }} rounded-full text-xs font-bold transition-colors">
									{{ $cat->posts_count }}
								</span>
							</a>
						@endforeach
					</div>
				</div>
			@endif

			{{-- Newsletter removed per request --}}

			{{-- Popular Tags (Optional) --}}
			<div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-100">
				<h3 class="text-sm font-bold text-gray-900 mb-4">Popüler Etiketler</h3>
				<div class="flex flex-wrap gap-2">
					<span class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 hover:border-blue-500 hover:text-blue-700 cursor-pointer transition-all">#teknoloji</span>
					<span class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 hover:border-blue-500 hover:text-blue-700 cursor-pointer transition-all">#yazılım</span>
					<span class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 hover:border-blue-500 hover:text-blue-700 cursor-pointer transition-all">#tasarım</span>
					<span class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 hover:border-blue-500 hover:text-blue-700 cursor-pointer transition-all">#pazarlama</span>
					<span class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 hover:border-blue-500 hover:text-blue-700 cursor-pointer transition-all">#yapay-zeka</span>
				</div>
			</div>
		</aside>
	</div>
@endsection