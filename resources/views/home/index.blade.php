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

	{{-- HERO SECTION --}}
	<section class="relative -mt-8 mb-24 overflow-hidden">
		<div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 opacity-60"></div>
		<div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
		<div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
		<div class="absolute bottom-0 left-1/3 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
		
		<div class="relative container mx-auto px-4 pt-20 pb-24">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				{{-- Hero Content --}}
				<div class="space-y-8 z-10">
					@if($firstFeatured)
						<div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full text-white text-sm font-semibold shadow-lg backdrop-blur-sm">
							<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
								<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
							</svg>
							<span>{{ $firstFeatured->categories->first()->name ?? 'Öne Çıkan' }}</span>
						</div>
						
						<h1 class="text-5xl lg:text-7xl font-black text-gray-900 leading-tight">
							<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
								{{ Str::limit($firstFeatured->title, 60) }}
							</span>
						</h1>
						
						<p class="text-xl text-gray-600 leading-relaxed">
							{{ $firstFeatured->excerpt ?? Str::limit(strip_tags($firstFeatured->content), 180) }}
						</p>
						
						<div class="flex flex-wrap items-center gap-6">
							<div class="flex items-center space-x-2 text-gray-600">
								<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
								<span class="text-sm font-medium">{{ $firstFeatured->published_at?->format('d M Y') }}</span>
							</div>
							@if(isset($firstFeatured->reading_time))
								<div class="flex items-center space-x-2 text-gray-600">
									<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
									</svg>
									<span class="text-sm font-medium">{{ $firstFeatured->reading_time }} dk okuma</span>
								</div>
							@endif
						</div>
						
						<div class="flex flex-wrap gap-4">
							<a href="{{ $routePostsShow ? route('posts.show', $firstFeatured->slug ?? $firstFeatured->id) : '#' }}" 
							   class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl hover:shadow-2xl hover:shadow-blue-500/50 transform hover:scale-105 transition-all duration-300">
								Yazıyı Oku
								<svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
								</svg>
							</a>
							<button class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-bold rounded-2xl border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
								<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
								</svg>
								Kaydet
							</button>
						</div>
					@else
						<h1 class="text-6xl lg:text-8xl font-black text-gray-900">
							<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
								Deta
							</span><br>
							<span class="text-gray-900">Dijital Demokrasi ve Toplum Araştırma Merkezi</span>
						</h1>
						<p class="text-2xl text-gray-600">
							Dijital çağda demokrasi ve toplum araştırmalarına odaklanan, yenilikçi çözümler üreten araştırma merkezi.
						</p>
					@endif
				</div>
				
				{{-- Hero Image --}}
				<div class="relative group">
					<div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-3xl blur-2xl opacity-25 group-hover:opacity-40 transition duration-1000"></div>
					<div class="relative aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl">
						@if($hero)
						<img src="{{ $hero->url }}" class="w-full h-full object-cover object-top transform group-hover:scale-110 transition duration-700" alt="{{ $firstFeatured->title ?? '' }}">
						@else
						<img src="{{ asset('asset/hero1.png') }}" class="w-full h-full object-cover object-top transform group-hover:scale-110 transition duration-700" alt="Hero">
						@endif
						<div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
					</div>
				</div>
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
			
			<div class="relative z-10 text-center max-w-3xl mx-auto">
				<h2 class="text-4xl lg:text-6xl font-black text-white mb-6">
					İlham Verici İçerikler<br>Seni Bekliyor
				</h2>
				<p class="text-xl text-blue-100 mb-10 leading-relaxed">
					Her gün yeni makaleler, rehberler ve uzman görüşleriyle büyümeye devam et. Topluluğumuza katıl ve fark yarat!
				</p>
				<div class="flex flex-wrap justify-center gap-4">
					<a href="#" class="inline-flex items-center px-10 py-5 bg-white text-gray-900 font-black rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg">
						<span>Hemen Başla</span>
						<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
						</svg>
					</a>
					<a href="#" class="inline-flex items-center px-10 py-5 bg-white/10 backdrop-blur-md text-white font-black rounded-full border-2 border-white/30 hover:bg-white/20 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg">
						<span>Daha Fazla Keşfet</span>
					</a>
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