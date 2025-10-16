@extends('layouts.app')

@section('title', 'Ana Sayfa - En İyi İçerikler')

@section('content')
	@php
		$firstFeatured = $featuredPosts->first();
		$mediaList = $firstFeatured ? ($firstFeatured->media ?? collect()) : collect();
		$hero = $mediaList->firstWhere('is_primary', true) ?? $mediaList->first();
		$routePostsShow = \Illuminate\Support\Facades\Route::has('posts.show');
	@endphp

	{{-- HERO SECTION - Ultra Modern Design --}}
	<section class="relative -mt-8 mb-24 overflow-hidden">
		<div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 opacity-60"></div>
		<div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
		<div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
		<div class="absolute bottom-0 left-1/3 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
		
		<div class="relative container mx-auto px-4 pt-20 pb-24">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				{{-- Hero Content --}}
				<div class="space-y-8 z-10">
					@if($firstFeatured)
						<div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full text-white text-sm font-semibold shadow-lg backdrop-blur-sm">
							<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
								<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
							</svg>
							<span>{{ $firstFeatured->categories->first()->name ?? 'Öne Çıkan' }}</span>
						</div>
						
						<h1 class="text-5xl lg:text-7xl font-black text-gray-900 leading-tight">
							<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600">
								{{ Str::limit($firstFeatured->title, 60) }}
							</span>
						</h1>
						
						<p class="text-xl text-gray-600 leading-relaxed">
							{{ $firstFeatured->excerpt ?? Str::limit(strip_tags($firstFeatured->content), 180) }}
						</p>
						
						<div class="flex flex-wrap items-center gap-6">
							<div class="flex items-center space-x-2 text-gray-600">
								<div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
									{{ substr($firstFeatured->author->name ?? 'A', 0, 1) }}
								</div>
								<div>
									<p class="font-semibold text-sm">{{ $firstFeatured->author->name ?? 'Admin' }}</p>
									<p class="text-xs text-gray-500">{{ $firstFeatured->published_at?->format('d M Y') }}</p>
								</div>
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
							   class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-2xl hover:shadow-2xl hover:shadow-purple-500/50 transform hover:scale-105 transition-all duration-300">
								Yazıyı Oku
								<svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
								</svg>
							</a>
							<button class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-bold rounded-2xl border-2 border-gray-200 hover:border-purple-500 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
								<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
								</svg>
								Kaydet
							</button>
						</div>
					@else
						<h1 class="text-6xl lg:text-8xl font-black text-gray-900">
							<span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600">
								İlham Veren
							</span><br>
							<span class="text-gray-900">İçerikler</span>
						</h1>
						<p class="text-2xl text-gray-600">
							Keşfet, öğren ve büyü. En güncel trendler ve uzman görüşleri bir arada.
						</p>
					@endif
				</div>
				
				{{-- Hero Image --}}
				<div class="relative group">
					<div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-3xl blur-2xl opacity-25 group-hover:opacity-40 transition duration-1000"></div>
					<div class="relative aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl">
						@if($hero)
							<img src="{{ $hero->url }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="{{ $firstFeatured->title ?? '' }}">
						@else
							<div class="w-full h-full bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500"></div>
						@endif
						<div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	{{-- FEATURED ARTICLES - Bento Grid Style --}}
	@if($featuredPosts->count() > 1)
		<section class="container mx-auto px-4 mb-32">
			<div class="flex items-center justify-between mb-12">
				<div>
					<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-2">Öne Çıkan Bloglar</h2>
					<div class="h-2 w-24 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
				</div>
				<a href="#" class="group hidden md:flex items-center space-x-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-full hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-600 transition-all duration-300">
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
								<div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500"></div>
							@endif
							<div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
							
							<div class="absolute inset-0 p-8 flex flex-col justify-end">
								@if($post->categories->isNotEmpty())
									<span class="inline-flex self-start items-center px-4 py-2 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-full mb-4 border border-white/30">
										{{ $post->categories->first()->name }}
									</span>
								@endif
								
								<h3 class="text-2xl {{ $index == 0 ? 'lg:text-4xl' : 'lg:text-3xl' }} font-black text-white mb-3 line-clamp-3 group-hover:text-blue-300 transition-colors">
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
		<div class="grid lg:grid-cols-3 gap-12">
			{{-- Latest Posts --}}
			<div class="lg:col-span-2">
				<div class="flex items-center justify-between mb-8">
					<div>
						<h2 class="text-4xl font-black text-gray-900 mb-2">Son Bloglar</h2>
						<div class="h-2 w-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
					</div>
				</div>
				
				{{-- Category Filter --}}
				<div class="flex gap-3 mb-10 overflow-x-auto pb-2 scrollbar-hide">
					<button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-2xl text-sm font-bold whitespace-nowrap shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
						Tümü
					</button>
					@foreach($topCategories->take(5) as $cat)
						<button class="px-6 py-3 bg-white text-gray-700 rounded-2xl text-sm font-bold whitespace-nowrap hover:bg-gray-900 hover:text-white transition-all duration-300 border-2 border-gray-200 hover:border-gray-900 transform hover:scale-105">
							{{ $cat->name }}
						</button>
					@endforeach
				</div>

				<div class="space-y-8">
					@forelse ($latestPosts as $post)
						@php $img = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
						<article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
							<div class="flex flex-col md:flex-row">
								<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="relative w-full md:w-80 h-64 md:h-auto flex-shrink-0 overflow-hidden">
									@if($img)
										<img src="{{ $img->url }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="{{ $img->alt }}">
									@else
										<div class="w-full h-full bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400"></div>
									@endif
									<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
								</a>
								
								<div class="p-8 flex flex-col justify-between flex-grow">
									<div>
										@if($post->categories->isNotEmpty())
											<span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 text-xs font-bold rounded-full mb-4">
												{{ $post->categories->first()->name }}
											</span>
										@endif
										
										<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="block group">
											<h3 class="text-2xl font-black text-gray-900 mb-3 line-clamp-2 group-hover:bg-clip-text group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 transition-all duration-300">
												{{ $post->title }}
											</h3>
										</a>
										
										<p class="text-gray-600 text-lg line-clamp-2 mb-6">
											{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 140) }}
										</p>
									</div>
									
									<div class="flex items-center justify-between">
										<div class="flex items-center space-x-4 text-sm text-gray-500">
											<span class="flex items-center font-medium">
												<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
												</svg>
												{{ $post->published_at?->format('d.m.Y') }}
											</span>
											@if(isset($post->reading_time))
												<span class="flex items-center font-medium">
													<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
													</svg>
													{{ $post->reading_time }} dk
												</span>
											@endif
										</div>
										<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-full hover:shadow-xl transform hover:scale-105 transition-all duration-300">
											<span>Oku</span>
											<svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
											</svg>
										</a>
									</div>
								</div>
							</div>
						</article>
					@empty
						<div class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl">
							<svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
							</svg>
							<p class="text-gray-500 text-xl font-semibold">Henüz yazı bulunmuyor</p>
						</div>
					@endforelse
				</div>
			</div>

			{{-- Sidebar --}}
			<div class="space-y-8">
				{{-- Popular Posts --}}
				@if($popularPosts->count())
					<div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 rounded-3xl p-8 shadow-2xl overflow-hidden">
						<div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
						<div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16"></div>
						
						<div class="relative z-10">
							<h3 class="text-2xl font-black text-white mb-8 flex items-center">
								<svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 20 20">
									<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
								</svg>
								Popüler Bloglar
							</h3>
							<div class="space-y-5">
								@foreach($popularPosts->take(5) as $index => $post)
									<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="flex items-start space-x-4 group">
										<span class="flex-shrink-0 w-10 h-10 bg-white text-purple-600 rounded-xl flex items-center justify-center font-black text-lg shadow-lg">
											{{ $index + 1 }}
										</span>
										<div class="flex-grow">
											<h4 class="font-bold text-white line-clamp-2 group-hover:text-blue-200 transition-colors mb-2">
												{{ $post->title }}
											</h4>
											<div class="flex items-center text-xs text-blue-100">
												<span>{{ $post->published_at?->format('d.m.Y') }}</span>
												@if($post->categories->isNotEmpty())
													<span class="mx-2">•</span>
													<span>{{ $post->categories->first()->name }}</span>
												@endif
											</div>
										</div>
									</a>
								@endforeach
							</div>
						</div>
					</div>
				@endif

				{{-- Categories --}}
				@if($topCategories->count())
					<div class="bg-white rounded-3xl p-8 shadow-xl">
						<h3 class="text-2xl font-black text-gray-900 mb-8 flex items-center">
							<svg class="w-7 h-7 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
							</svg>
							Kategoriler
						</h3>
						<div class="space-y-3">
							@foreach($topCategories->take(6) as $cat)
								<a href="#" class="group flex items-center justify-between p-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300 border-2 border-transparent hover:border-purple-200">
									<span class="font-bold text-gray-700 group-hover:text-purple-600 transition-colors">
										{{ $cat->name }}
									</span>
									<span class="px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 rounded-xl text-sm font-black group-hover:from-blue-600 group-hover:to-purple-600 group-hover:text-white transition-all duration-300">
										{{ $cat->posts_count }}
									</span>
								</a>
							@endforeach
						</div>
					</div>
				@endif

				{{-- Newsletter removed per request --}}
			</div>
		</div>
	</section>

	{{-- UPCOMING EVENTS --}}
	@if($upcomingEvents->count())
		<section class="container mx-auto px-4 mb-32">
			<div class="flex items-center justify-between mb-12">
				<div>
					<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-2">Yaklaşan Etkinlikler</h2>
					<div class="h-2 w-24 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
				</div>
			</div>
			
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				@foreach($upcomingEvents as $event)
					<article class="group relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
						<div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-purple-500/10 rounded-full -mr-16 -mt-16"></div>
						
						<div class="relative z-10">
							<div class="flex items-start space-x-4 mb-6">
								<div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg">
									<span class="text-3xl font-black">{{ $event->event_date?->format('d') }}</span>
									<span class="text-xs uppercase font-bold">{{ $event->event_date?->format('M') }}</span>
								</div>
								<div class="flex-grow">
									<div class="text-sm text-gray-500 font-semibold mb-2">
										{{ $event->event_date?->format('H:i') }}
									</div>
									<h3 class="text-xl font-black text-gray-900 line-clamp-2 group-hover:bg-clip-text group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 transition-all duration-300">
										{{ $event->title }}
									</h3>
								</div>
							</div>
							<p class="text-gray-600 line-clamp-3 mb-6 leading-relaxed">
								{{ Str::limit(strip_tags($event->description), 120) }}
							</p>
							<a href="#" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-full hover:shadow-xl transform hover:scale-105 transition-all duration-300">
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

	{{-- RECENT COMMENTS --}}
	@if($recentComments->count())
		<section class="container mx-auto px-4 mb-32">
			<div class="flex items-center justify-between mb-12">
				<div>
					<h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-2">Son Yorumlar</h2>
					<div class="h-2 w-24 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
				</div>
			</div>
			
			<div class="grid md:grid-cols-2 gap-8">
				@foreach($recentComments as $comment)
					<div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
						<div class="flex items-start space-x-4">
							<div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg">
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
									<a href="{{ $routePostsShow ? route('posts.show', $comment->post->slug ?? $comment->post->id) : '#' }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-purple-600 transition-colors">
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
		<div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 rounded-3xl p-12 lg:p-20 overflow-hidden shadow-2xl">
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