@extends('layouts.app')

@section('title', 'Deta - Dijital Demokrasi ve Toplum Araştırma Merkezi')

@section('content')
	@php
		$firstFeatured = $featuredPosts->first();
		$mediaList = $firstFeatured ? ($firstFeatured->media ?? collect()) : collect();
		$hero = $mediaList->firstWhere('is_primary', true) ?? $mediaList->first();
		$routePostsShow = \Illuminate\Support\Facades\Route::has('posts.show');
		$activeCatId = request('category');
	@endphp

	{{-- HERO SLIDER SECTION --}}
	@if($heroSliders->count() > 0)
		<section class="relative -mt-8 mb-24 overflow-hidden">
			<div class="hero-slider-container relative h-[700px] lg:h-[850px]">
				@foreach($heroSliders as $index => $slider)
					@if($slider->button_url)
						<a href="{{ $slider->button_url }}" class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
						   data-desktop="{{ str_starts_with($slider->image, 'http') ? $slider->image : asset($slider->image) }}"
						   data-mobile="{{ $slider->mobile_image ? (str_starts_with($slider->mobile_image, 'http') ? $slider->mobile_image : asset($slider->mobile_image)) : (str_starts_with($slider->image, 'http') ? $slider->image : asset($slider->image)) }}">
					@else
						<div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
							 data-desktop="{{ str_starts_with($slider->image, 'http') ? $slider->image : asset($slider->image) }}"
							 data-mobile="{{ $slider->mobile_image ? (str_starts_with($slider->mobile_image, 'http') ? $slider->mobile_image : asset($slider->mobile_image)) : (str_starts_with($slider->image, 'http') ? $slider->image : asset($slider->image)) }}">
					@endif
						<div class="relative z-10 container mx-auto px-4 h-full flex items-center">
							<div class="max-w-4xl">
								@if($slider->title)
									<h1 class="text-4xl lg:text-6xl font-black text-white leading-tight mb-6 drop-shadow-lg">
										{{ $slider->title }}
									</h1>
								@endif
								
								@if($slider->description)
									<p class="text-xl lg:text-2xl text-white/90 leading-relaxed mb-8 drop-shadow-md">
										{{ $slider->description }}
									</p>
								@endif
								
								{{-- Buton artık gözükmüyor, tüm resim tıklanabilir --}}
							</div>
						</div>
					@if($slider->button_url)
						</a>
					@else
						</div>
					@endif
				@endforeach
				
				{{-- Slider Controls --}}
				@if($heroSliders->count() > 1)
					<div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
						<div class="flex space-x-3">
							@foreach($heroSliders as $index => $slider)
								<button class="slider-dot {{ $index === 0 ? 'active' : '' }}" 
										data-slide="{{ $index }}"></button>
							@endforeach
						</div>
					</div>
					
					<button class="slider-prev absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
						</svg>
					</button>
					
					<button class="slider-next absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
						</svg>
					</button>
				@endif
			</div>
		</section>
	@else
		{{-- Fallback Hero Section --}}
		<section class="relative -mt-8 mb-24 overflow-hidden">
			<div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 opacity-60"></div>
			<div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
			<div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
			<div class="absolute bottom-0 left-1/3 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
			
			<div class="relative container mx-auto px-4 pt-20 pb-24">
				<div class="text-center">
					<div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full text-white text-sm font-semibold shadow-lg backdrop-blur-sm mb-8">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
							<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
						</svg>
						<span>Deta</span>
					</div>
					
					<h1 class="text-5xl lg:text-7xl font-black text-gray-900 leading-tight mb-6">
						<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
							Dijital Demokrasi ve Toplum Araştırma Merkezi
						</span>
					</h1>
					
					<p class="text-xl text-gray-600 leading-relaxed max-w-4xl mx-auto mb-8">
						Modern toplumun dijital dönüşümünü anlamak ve demokratik süreçleri güçlendirmek için araştırma ve analiz yapıyoruz.
					</p>
					
					<a href="#latest-posts" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
						<span>Keşfet</span>
						<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
						</svg>
					</a>
				</div>
			</div>
		</section>
	@endif

	{{-- TÜRKAB KIMLIK BÖLÜMÜ --}}
	<section class="container mx-auto px-4 mb-32">
		<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
			{{-- TÜRKAB Logo Section --}}
			<div class="text-center mb-12">
				<div class="inline-flex items-center space-x-4 mb-6">
					<div class="w-20 h-20 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
						<svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
							<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
						</svg>
					</div>
					<div class="text-left">
						<h2 class="text-3xl font-black text-gray-900">Deta</h2>
						<p class="text-lg text-gray-600 font-semibold">Dijital Demokrasi ve Toplum Araştırma Merkezi</p>
					</div>
				</div>
			</div>

			{{-- Slogan --}}
			<div class="mb-12 p-8 bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200 rounded-2xl border-l-4 border-blue-500">
				<p class="text-3xl font-black text-blue-800 text-center">
					"Yeni Neslin Kardeşlik Hareketi"
				</p>
			</div>

			{{-- Kimlik Açıklaması --}}
			<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
				<div>
					<h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
						<span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
						Biz Kimiz?
					</h3>
					<p class="text-lg text-gray-700 leading-relaxed">
						Bizler, milli ve manevi duygularla süslenmiş bir toplum ve gençlik inşa etmek, oluşan bu kardeşlik bilincini uluslararası düzeyde temsilini ve tesisini sağlamak hayaliyle yola çıkmış insanlarız.
					</p>
				</div>
				
				<div>
					<h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
						<span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
						Hedefimiz
					</h3>
					<p class="text-lg text-gray-700 leading-relaxed">
						Türkiye'nin 20 ilinde il ve ilçe temsilcilikleri bulunan, 6 yurt dışı temsilciliği bulunan, yaklaşık 10.000 gönüllü üyesi olan bir sivil toplum kuruluşuyuz.
					</p>
				</div>
			</div>

			{{-- CTA Buttons --}}
			<div class="text-center mt-12">
				<a href="{{ route('about.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
					<span>Hakkımızda</span>
					<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</a>
			</div>
		</div>
	</section>

	{{-- FEATURED ARTICLES --}}
	@if($featuredPosts->count() > 1)
		<section class="container mx-auto px-4 mb-32">
			<div class="flex items-center justify-between mb-12">
				<div>
					<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-2">Öne Çıkan Bloglar</h2>
					<div class="h-2 w-24 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full"></div>
				</div>
				<a href="#" class="group hidden md:flex items-center space-x-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-full hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
					<span>Tümünü Gör</span>
					<svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
					</svg>
				</a>
			</div>
			
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
				@foreach ($featuredPosts->skip(1)->take(6) as $index => $post)
					@php 
						$img = $post->media->firstWhere('is_primary', true) ?: $post->media->first();
						$spanClass = ($index == 0) ? 'md:col-span-2 md:row-span-2' : '';
					@endphp
					<article class="group relative {{ $spanClass }} rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
						<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="block relative h-full min-h-[300px]">
							@if($img)
								<img src="{{ $img->url }}" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="{{ $img->alt }}">
							@else
								<div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700"></div>
							@endif
							<div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
							
							<div class="absolute inset-0 p-8 flex flex-col justify-end">
								@if($post->categories->isNotEmpty())
									<span class="inline-flex self-start items-center px-4 py-2 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-full mb-4 border border-white/30">
										{{ $post->categories->first()->name }}
									</span>
								@endif
								
								<h3 class="text-2xl {{ $index == 0 ? 'lg:text-4xl' : 'lg:text-3xl' }} font-black text-white mb-3 line-clamp-3 group-hover:text-blue-200 transition-colors">
									{{ $post->title }}
								</h3>
								
								@if($index == 0)
									<p class="text-gray-200 text-lg line-clamp-2 mb-4">
										{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
									</p>
								@endif
								
								<div class="flex items-center justify-between text-sm text-gray-300">
									<span class="flex items-center">
										<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
										</svg>
										{{ $post->published_at?->format('d M Y') }}
									</span>
									@if(isset($post->reading_time))
										<span class="flex items-center">
											<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
											</svg>
											{{ $post->reading_time }} dk
										</span>
									@endif
								</div>
							</div>
						</a>
					</article>
				@endforeach
			</div>
		</section>
	@endif

	{{-- LATEST POSTS & SIDEBAR --}}
	<section class="container mx-auto px-4 mb-32">
		{{-- Latest Posts - 4x4x4 Grid --}}
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
			{{-- Section Header --}}
			<div class="col-span-full mb-8">
				<div class="flex items-center justify-between">
					<div>
						<h2 class="text-4xl font-black text-gray-900 mb-2">Son Bloglar</h2>
						<div class="h-2 w-20 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full"></div>
					</div>
				</div>
				
				{{-- Category Filter --}}
				<div class="flex gap-3 mt-6 overflow-x-auto pb-2 scrollbar-hide">
					<a href="{{ url('/?') }}" class="px-6 py-3 rounded-2xl text-sm font-bold whitespace-nowrap shadow-lg transition-all duration-300 {{ $activeCatId ? 'bg-white text-gray-700 border-2 border-gray-200 hover:bg-gray-900 hover:text-white hover:border-gray-900 transform hover:scale-105' : 'bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:shadow-xl transform hover:scale-105' }}">
						Tümü
					</a>
					@foreach($topCategories->take(5) as $cat)
						<a href="{{ url('/?category='.$cat->id) }}" class="px-6 py-3 rounded-2xl text-sm font-bold whitespace-nowrap transition-all duration-300 {{ (int)$activeCatId === (int)$cat->id ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg transform scale-[1.03]' : 'bg-white text-gray-700 border-2 border-gray-200 hover:bg-gray-900 hover:text-white hover:border-gray-900 transform hover:scale-105' }}">
							{{ $cat->name }}
						</a>
					@endforeach
				</div>
			</div>
			@forelse ($latestPosts as $post)
				@php $img = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
				<article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
					{{-- Image --}}
					<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="block relative h-64 overflow-hidden">
						@if($img)
							<img src="{{ $img->url }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="{{ $img->alt }}">
						@else
							<div class="w-full h-full bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 flex items-center justify-center">
								<svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
							</div>
						@endif
						<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
						
						{{-- Category Badge --}}
						@if($post->categories->isNotEmpty())
							<div class="absolute top-4 left-4">
								<span class="inline-flex items-center px-3 py-1.5 bg-white/95 backdrop-blur-sm text-gray-900 text-xs font-bold rounded-full shadow-lg">
									{{ $post->categories->first()->name }}
								</span>
							</div>
						@endif
					</a>
					
					{{-- Content --}}
					<div class="p-6">
						<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="block group">
							<h3 class="text-lg font-black text-gray-900 mb-3 line-clamp-2 group-hover:bg-clip-text group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-300">
								{{ $post->title }}
							</h3>
						</a>
						
						<p class="text-gray-600 text-sm line-clamp-3 mb-4 leading-relaxed">
							{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
						</p>
						
						{{-- Meta Info --}}
						<div class="flex items-center justify-between text-xs text-gray-500 mb-4">
							<span class="flex items-center font-medium">
								<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
								{{ $post->published_at?->format('d.m.Y') }}
							</span>
							@if(isset($post->reading_time))
								<span class="flex items-center font-medium">
									<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
									</svg>
									{{ $post->reading_time }} dk
								</span>
							@endif
						</div>
						
						{{-- Read More Button --}}
						<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-bold rounded-full hover:shadow-lg transform hover:scale-105 transition-all duration-300">
							<span>Oku</span>
							<svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
						</a>
					</div>
				</article>
			@empty
				<div class="col-span-full">
					<div class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl">
						<svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
						</svg>
						<p class="text-gray-500 text-xl font-semibold">Henüz yazı bulunmuyor</p>
					</div>
				</div>
			@endforelse
		</div>

		{{-- Pagination --}}
		@if($latestPosts->hasPages())
			<div class="mt-12 flex justify-center">
				<div class="flex items-center space-x-2">
							{{-- Previous Page --}}
							@if($latestPosts->onFirstPage())
								<span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
									<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
									</svg>
								</span>
							@else
								<a href="{{ $latestPosts->previousPageUrl() }}" class="px-4 py-2 bg-white text-gray-700 border-2 border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 transform hover:scale-105">
									<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
									</svg>
								</a>
							@endif

							{{-- Page Numbers --}}
							@foreach($latestPosts->getUrlRange(1, $latestPosts->lastPage()) as $page => $url)
								@if($page == $latestPosts->currentPage())
									<span class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-bold shadow-lg">
										{{ $page }}
									</span>
								@else
									<a href="{{ $url }}" class="px-4 py-2 bg-white text-gray-700 border-2 border-gray-200 rounded-lg hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-700 hover:text-white hover:border-transparent transition-all duration-300 transform hover:scale-105">
										{{ $page }}
									</a>
								@endif
							@endforeach

							{{-- Next Page --}}
							@if($latestPosts->hasMorePages())
								<a href="{{ $latestPosts->nextPageUrl() }}" class="px-4 py-2 bg-white text-gray-700 border-2 border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 transform hover:scale-105">
									<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
									</svg>
								</a>
							@else
								<span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
									<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
									</svg>
								</span>
							@endif
						</div>
					</div>
				@endif
	</section>

	{{-- TÜRKAB PROJELERİ --}}
	<section class="container mx-auto px-4 mb-32">
		<div class="text-center mb-16">
			<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-6">
				<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
					Projelerimiz
				</span>
			</h2>
			<p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
				Kardeşlik bilincini güçlendiren ve toplumsal dayanışmayı artıran projelerimiz
			</p>
		</div>
		
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
			{{-- Medeniyet Kardeşliği --}}
			<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 group">
				<div class="flex items-center gap-4 mb-4">
					<div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
						</svg>
					</div>
					<h3 class="text-xl font-black text-gray-900">Medeniyet Kardeşliği</h3>
				</div>
				<p class="text-gray-700">Farklı kültürler arasında köprü kuran, medeniyetler arası diyalogu güçlendiren projelerimiz.</p>
			</div>

			{{-- Kampüs Kardeşliği --}}
			<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 group">
				<div class="flex items-center gap-4 mb-4">
					<div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
						</svg>
					</div>
					<h3 class="text-xl font-black text-gray-900">Kampüs Kardeşliği</h3>
				</div>
				<p class="text-gray-700">Üniversite öğrencileri arasında kardeşlik bağlarını güçlendiren kampüs etkinlikleri.</p>
			</div>

			{{-- Fikir Mektebi --}}
			<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 group">
				<div class="flex items-center gap-4 mb-4">
					<div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
						</svg>
					</div>
					<h3 class="text-xl font-black text-gray-900">Fikir Mektebi</h3>
				</div>
				<p class="text-gray-700">Gençlerin düşünce dünyasını zenginleştiren, fikir üretimini teşvik eden eğitim programları.</p>
			</div>

			{{-- Lider Anne --}}
			<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 group">
				<div class="flex items-center gap-4 mb-4">
					<div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
						</svg>
					</div>
					<h3 class="text-xl font-black text-gray-900">Lider Anne</h3>
				</div>
				<p class="text-gray-700">Annelerin toplumsal liderlik rollerini güçlendiren, aile değerlerini destekleyen projeler.</p>
			</div>

			{{-- Kardeşlik Umresi --}}
			<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 group">
				<div class="flex items-center gap-4 mb-4">
					<div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
						</svg>
					</div>
					<h3 class="text-xl font-black text-gray-900">Kardeşlik Umresi</h3>
				</div>
				<p class="text-gray-700">Manevi değerleri güçlendiren, kardeşlik bağlarını pekiştiren umre organizasyonları.</p>
			</div>

			{{-- Kardeşlik Merkezi --}}
			<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 group">
				<div class="flex items-center gap-4 mb-4">
					<div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
						</svg>
					</div>
					<h3 class="text-xl font-black text-gray-900">Kardeşlik Merkezi</h3>
				</div>
				<p class="text-gray-700">Toplumsal dayanışmayı güçlendiren, sosyal yardımlaşmayı destekleyen merkezler.</p>
			</div>
		</div>

		{{-- Ortadoğu Siyaset Okulu - Geniş Kart --}}
		<div class="mt-6">
			<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200 hover:shadow-lg transition-all duration-300 group">
				<div class="flex items-center gap-4 mb-4">
					<div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
						<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
						</svg>
					</div>
					<h3 class="text-2xl font-black text-gray-900">Ortadoğu Siyaset Okulu</h3>
				</div>
				<p class="text-lg text-gray-700">Bölgesel siyasi gelişmeleri analiz eden, genç liderler yetiştiren akademik programlar.</p>
			</div>
		</div>

		{{-- CTA --}}
		<div class="text-center mt-12">
			<a href="{{ route('about.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
				<span>Tüm Projeleri Gör</span>
				<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
				</svg>
			</a>
		</div>
	</section>

    {{-- UPCOMING OR RECENT EVENTS --}}
    @if($upcomingEvents->count())
		<section class="container mx-auto px-4 mb-32">
			<div class="flex items-center justify-between mb-12">
				<div>
                    <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-2">{{ ($eventsArePast ?? false) ? 'Geçmiş Etkinlikler' : 'Yaklaşan Etkinlikler' }}</h2>
					<div class="h-2 w-24 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full"></div>
				</div>
			</div>
			
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				@foreach($upcomingEvents as $event)
					<article class="group relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
						<div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-blue-600/10 rounded-full -mr-16 -mt-16"></div>
						
						<div class="relative z-10">
							<div class="flex items-start space-x-4 mb-6">
								<div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg">
									<span class="text-3xl font-black">{{ $event->event_date?->format('d') }}</span>
									<span class="text-xs uppercase font-bold">{{ $event->event_date?->format('M') }}</span>
								</div>
								<div class="flex-grow">
									<div class="text-sm text-gray-500 font-semibold mb-2">
										{{ $event->event_date?->format('H:i') }}
									</div>
									<h3 class="text-xl font-black text-gray-900 line-clamp-2 group-hover:bg-clip-text group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-300">
										{{ $event->title }}
									</h3>
								</div>
							</div>
							<p class="text-gray-600 line-clamp-3 mb-6 leading-relaxed">
								{{ Str::limit(strip_tags($event->description), 120) }}
							</p>
                            <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-xl transform hover:scale-105 transition-all duration-300">
								<span>Detayları Gör</span>
								<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
								</svg>
							</a>
						</div>
					</article>
				@endforeach
			</div>
		</section>
	@endif

	{{-- TÜRKAB TEMSİLCİLİK İSTATİSTİKLERİ --}}
	<section class="container mx-auto px-4 mb-32">
		<div class="text-center mb-16">
			<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-6">
				<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
					Temsilcilik Ağımız
				</span>
			</h2>
			<p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
				Türkiye'nin dört bir yanında ve yurt dışında faaliyet gösteren geniş temsilcilik ağımız
			</p>
		</div>
		
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
			{{-- Yurt İçi Temsilcilikler --}}
			<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
				<div class="text-center mb-8">
					<div class="inline-flex items-center gap-3 mb-4">
						<div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center">
							<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
							</svg>
						</div>
						<h3 class="text-3xl font-black text-gray-900">Yurt İçi Temsilciliklerimiz</h3>
					</div>
					<p class="text-gray-600">Türkiye'nin 20 farklı ilinde faaliyet gösteren temsilciliklerimiz</p>
				</div>

				<div class="grid grid-cols-2 gap-3">
					@php
					$domesticCities = [
						'İstanbul', 'Ankara', 'İzmir', 'Mersin', 'Adana',
						'Kahramanmaraş', 'Malatya', 'Adıyaman', 'Gaziantep', 'Şanlıurfa',
						'Diyarbakır', 'Bingöl', 'Şırnak', 'Muş', 'Van',
						'Giresun', 'Afyon', 'Isparta', 'Batman', 'Hatay'
					];
					@endphp
					
					@foreach($domesticCities as $index => $city)
					<div class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300 hover:scale-105">
						<div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
							<span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
						</div>
						<span class="text-gray-800 font-semibold text-sm">{{ $city }}</span>
					</div>
					@endforeach
				</div>
			</div>

			{{-- Yurt Dışı Temsilcilikler --}}
			<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
				<div class="text-center mb-8">
					<div class="inline-flex items-center gap-3 mb-4">
						<div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center">
							<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
						</div>
						<h3 class="text-3xl font-black text-gray-900">Yurt Dışı Temsilciliklerimiz</h3>
					</div>
					<p class="text-gray-600">6 farklı ülkede faaliyet gösteren temsilciliklerimiz</p>
				</div>

				<div class="space-y-3">
					@php
					$internationalCountries = [
						'Suudi Arabistan', 'İran', 'Almanya', 'İngiltere', 'Filistin', 'Fransa'
					];
					@endphp
					
					@foreach($internationalCountries as $index => $country)
					<div class="flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300 hover:scale-105">
						<div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
							<span class="text-white font-bold">{{ $index + 1 }}</span>
						</div>
						<span class="text-gray-800 font-semibold text-lg">{{ $country }}</span>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		{{-- İstatistik Kartları --}}
		<div class="mt-12 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
			<div class="text-center mb-8">
				<h3 class="text-2xl font-black text-gray-900 mb-4">Temsilcilik İstatistiklerimiz</h3>
				<p class="text-gray-600">Geniş coğrafyada faaliyet gösteren temsilcilik ağımız</p>
			</div>
			
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				<div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
					<div class="text-4xl font-black text-blue-600 mb-2">20</div>
					<p class="text-gray-700 font-semibold">Yurt İçi Temsilcilik</p>
					<p class="text-sm text-gray-500 mt-1">Türkiye genelinde</p>
				</div>
				<div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
					<div class="text-4xl font-black text-blue-600 mb-2">6</div>
					<p class="text-gray-700 font-semibold">Yurt Dışı Temsilcilik</p>
					<p class="text-sm text-gray-500 mt-1">Uluslararası</p>
				</div>
				<div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
					<div class="text-4xl font-black text-blue-600 mb-2">26</div>
					<p class="text-gray-700 font-semibold">Toplam Temsilcilik</p>
					<p class="text-sm text-gray-500 mt-1">Geniş ağ</p>
				</div>
			</div>
		</div>

		{{-- CTA --}}
		<div class="text-center mt-12">
			<a href="{{ route('about.representatives') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
				<span>Temsilciliklerimizi Keşfet</span>
				<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
				</svg>
			</a>
		</div>
	</section>

	{{-- FEATURED GALLERY SECTION --}}
	@if($featuredGalleries->isNotEmpty())
		<section class="container mx-auto px-4 mb-20">
			<div class="text-center mb-16">
				<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-6">
					Öne Çıkan Fotoğraflar
				</h2>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
					En güzel anları yakaladığımız fotoğraflarımızı keşfedin
				</p>
			</div>
			
			<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
				@foreach($featuredGalleries as $gallery)
					<div class="group relative aspect-square rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
						<img 
							src="{{ $gallery->thumbnail ?: $gallery->image }}" 
							alt="{{ $gallery->alt_text ?: $gallery->title ?: 'Galeri Fotoğrafı' }}"
							class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
						>
						<div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
						<div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
							@if($gallery->title)
								<h3 class="font-bold text-sm line-clamp-1">{{ $gallery->title }}</h3>
							@endif
							@if($gallery->category)
								<p class="text-xs text-blue-200 mt-1">{{ $gallery->category->name }}</p>
							@endif
						</div>
						<a href="{{ route('galleries.show', $gallery->slug) }}" class="absolute inset-0 z-10"></a>
					</div>
				@endforeach
			</div>
			
			<div class="text-center mt-12">
				<a href="{{ route('galleries.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
					<span>Tüm Galeriyi Gör</span>
					<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
					</svg>
				</a>
			</div>
		</section>
	@endif

	{{-- TÜRKAB MİSYON & VİZYON --}}
	<section class="container mx-auto px-4 mb-32">
		<div class="text-center mb-16">
			<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-6">
				<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
					Misyonumuz & Vizyonumuz
				</span>
			</h2>
			<p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
				TÜRKAB'ın temel değerleri ve gelecek hedefleri
			</p>
		</div>
		
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
			{{-- Misyon --}}
			<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
				<div class="text-center mb-8">
					<div class="inline-flex items-center gap-3 mb-4">
						<div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center">
							<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
						</div>
						<h3 class="text-3xl font-black text-gray-900">Misyonumuz</h3>
					</div>
				</div>
				
				<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
					<p class="text-lg text-gray-700 leading-relaxed">
						<strong class="text-blue-700 font-bold">Dinini, Tarihini, Kültürünü, Değerlerini ve En Önemlisi Kardeşlik Bilincini ve Hukukunu Bilen</strong>, <strong class="text-blue-700 font-bold">Çağın Gerektirdiği Bilgi ve Görgüyü Edinmiş</strong>, <strong class="text-blue-700 font-bold">Teknolojiyi Üst Düzeyde Kullanabilen</strong>, <strong class="text-blue-700 font-bold">Özgüveni Yüksek, İletişime Açık, Kendisini Güncelleyebilen, Okuyan, Araştıran, Kendisine Sürekli Daha İleri Hedefler Belirleyen</strong>, <strong class="text-blue-700 font-bold">Doğuyu da Batıyı da Tanıyan, Görevini Layıkıyla Yerine Getirebilecek Donanıma Sahip</strong> ve <strong class="text-blue-700 font-bold">İyiliği Emreden Kötülükten Sakındıran, Çevresine Örnek, Ahlaklı, Şuurlu ve Vatansever Nesiller Yetiştirmek</strong>.
					</p>
				</div>
			</div>

			{{-- Vizyon --}}
			<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
				<div class="text-center mb-8">
					<div class="inline-flex items-center gap-3 mb-4">
						<div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center">
							<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
							</svg>
						</div>
						<h3 class="text-3xl font-black text-gray-900">Vizyonumuz</h3>
					</div>
				</div>
				
				<div class="space-y-4">
					<div class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300">
						<div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
							<span class="text-white font-bold text-sm">1</span>
						</div>
						<div>
							<h4 class="text-lg font-black text-gray-900">Ülkemize Öncü</h4>
							<p class="text-gray-700 text-sm">Türkiye'de öncü ve lider bir sivil toplum kuruluşu olmak</p>
						</div>
					</div>
					
					<div class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300">
						<div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
							<span class="text-white font-bold text-sm">2</span>
						</div>
						<div>
							<h4 class="text-lg font-black text-gray-900">Dünyaya Örnek</h4>
							<p class="text-gray-700 text-sm">Dünyaya örnek teşkil eden bir model oluşturmak</p>
						</div>
					</div>
					
					<div class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300">
						<div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
							<span class="text-white font-bold text-sm">3</span>
						</div>
						<div>
							<h4 class="text-lg font-black text-gray-900">Donanımlı Nesiller</h4>
							<p class="text-gray-700 text-sm">Donanımlı ve inançlı nesiller yetiştirmek</p>
						</div>
					</div>
					
					<div class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300">
						<div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
							<span class="text-white font-bold text-sm">4</span>
						</div>
						<div>
							<h4 class="text-lg font-black text-gray-900">İdeal Toplum</h4>
							<p class="text-gray-700 text-sm">Kardeşlik bilinci ile ideal bir toplum oluşturmak</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Ahlak Değerleri --}}
		<div class="mt-12 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
			<div class="text-center mb-8">
				<h3 class="text-2xl font-black text-gray-900 mb-4">TÜRKAB Ahlakı</h3>
				<p class="text-gray-600">"Bir Türkab mensubu, çevresinde yürüyen ahlak olarak anılmalıdır."</p>
			</div>
			
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
				<div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
					<div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
						</svg>
					</div>
					<h4 class="font-black text-gray-900 mb-2">Hakikat Ahlakı</h4>
					<p class="text-sm text-gray-700">Hakikatten süzülen ahlak</p>
				</div>
				
				<div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
					<div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
						</svg>
					</div>
					<h4 class="font-black text-gray-900 mb-2">Kul Hakkı</h4>
					<p class="text-sm text-gray-700">Kul hakkını önceleyen ahlak</p>
				</div>
				
				<div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
					<div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
						</svg>
					</div>
					<h4 class="font-black text-gray-900 mb-2">İman Ahlakı</h4>
					<p class="text-sm text-gray-700">İmanı en güzel cila ile parlatan ahlak</p>
				</div>
				
				<div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
					<div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
						</svg>
					</div>
					<h4 class="font-black text-gray-900 mb-2">Eğitim Ahlakı</h4>
					<p class="text-sm text-gray-700">Muamelatı çepeçevre kuşatan ahlak</p>
				</div>
			</div>
		</div>

		{{-- CTA --}}
		<div class="text-center mt-12">
			<a href="{{ route('about.why-founded') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
				<span>Detaylı Bilgi Al</span>
				<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
				</svg>
			</a>
		</div>
	</section>

	{{-- RECENT COMMENTS --}}
	@if($recentComments->count())
		<section class="container mx-auto px-4 mb-32">
			<div class="flex items-center justify-between mb-12">
				<div>
				<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-2">Son Yorumlar</h2>
				<div class="h-2 w-24 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full"></div>
				</div>
			</div>
			
			<div class="grid md:grid-cols-2 gap-8">
				@foreach($recentComments as $comment)
					<div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
						<div class="flex items-start space-x-4">
							<div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg">
								{{ substr($comment->user_name ?? 'A', 0, 1) }}
							</div>
							<div class="flex-grow">
								<div class="flex items-center justify-between mb-3">
									<h4 class="font-black text-gray-900">{{ $comment->user_name ?? 'Anonim' }}</h4>
									<span class="text-xs text-gray-500 font-semibold">{{ $comment->created_at?->diffForHumans() }}</span>
								</div>
								<p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
									{{ $comment->content }}
								</p>
								@if($comment->post)
									<a href="{{ $routePostsShow ? route('posts.show', $comment->post->slug ?? $comment->post->id) : '#' }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
										<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
										</svg>
										<span class="line-clamp-1">{{ $comment->post->title }}</span>
									</a>
								@endif
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</section>
	@endif

	{{-- CTA SECTION --}}
	<section class="container mx-auto px-4 mb-20">
		<div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 rounded-3xl p-12 lg:p-20 overflow-hidden shadow-2xl">
			<div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-48 -mt-48"></div>
			<div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-48 -mb-48"></div>
			
			<div class="relative z-10 text-center max-w-4xl mx-auto">
				<div class="inline-flex items-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-bold shadow-lg mb-8">
					<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
						<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
					</svg>
					<span>TÜRKAB</span>
				</div>
				
				<h2 class="text-4xl lg:text-6xl font-black text-white mb-6">
					Kardeşlik Hareketine<br>Katıl, Fark Yarat!
				</h2>
				<p class="text-xl text-blue-100 mb-10 leading-relaxed">
					Milli ve manevi değerlerle donanmış, kardeşlik bilincini yayan bir toplum inşa etme yolculuğunda bizimle birlikte yürü. Yeni neslin kardeşlik hareketinin bir parçası ol!
				</p>
				<div class="flex flex-wrap justify-center gap-4">
					<a href="{{ route('about.member') }}" class="inline-flex items-center px-10 py-5 bg-white text-blue-700 font-black rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg">
						<span>Hemen Üye Ol</span>
						<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
						</svg>
					</a>
					<a href="{{ route('about.index') }}" class="inline-flex items-center px-10 py-5 bg-white/10 backdrop-blur-md text-white font-black rounded-full border-2 border-white/30 hover:bg-white/20 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg">
						<span>Hakkımızda Keşfet</span>
					</a>
				</div>
				
				{{-- İstatistikler --}}
				<div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
					<div class="text-center">
						<div class="text-3xl font-black text-white mb-2">10.000+</div>
						<p class="text-blue-200 font-semibold">Gönüllü Üye</p>
					</div>
					<div class="text-center">
						<div class="text-3xl font-black text-white mb-2">26</div>
						<p class="text-blue-200 font-semibold">Temsilcilik</p>
					</div>
					<div class="text-center">
						<div class="text-3xl font-black text-white mb-2">7</div>
						<p class="text-blue-200 font-semibold">Ana Proje</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<style>
		@keyframes blob {
			0% { transform: translate(0px, 0px) scale(1); }
			33% { transform: translate(30px, -50px) scale(1.1); }
			66% { transform: translate(-20px, 20px) scale(0.9); }
			100% { transform: translate(0px, 0px) scale(1); }
		}
		.animate-blob {
			animation: blob 7s infinite;
		}
		.animation-delay-2000 {
			animation-delay: 2s;
		}
		.animation-delay-4000 {
			animation-delay: 4s;
		}
		.scrollbar-hide::-webkit-scrollbar {
			display: none;
		}
		.scrollbar-hide {
			-ms-overflow-style: none;
			scrollbar-width: none;
		}
	</style>
@endsection