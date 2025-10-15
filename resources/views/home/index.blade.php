@extends('layouts.app')

@section('title', 'Ana Sayfa - En İyi İçerikler')

@section('content')
	@php
		$firstFeatured = $featuredPosts->first();
		$mediaList = $firstFeatured ? ($firstFeatured->media ?? collect()) : collect();
		$hero = $mediaList->firstWhere('is_primary', true) ?? $mediaList->first();
		$routePostsShow = \Illuminate\Support\Facades\Route::has('posts.show');
	@endphp

	{{-- HERO SECTION --}}
	<section class="relative -mt-8 mb-16">
		<div class="relative w-full h-[500px] md:h-[600px] rounded-3xl overflow-hidden group">
			@if($hero)
				<img src="{{ $hero->url }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $firstFeatured->title ?? '' }}">
			@else
				<div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600"></div>
			@endif
			<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
			
			{{-- Hero Content --}}
			<div class="absolute inset-0 flex flex-col justify-end p-8 md:p-12 lg:p-16">
				<div class="max-w-3xl">
                    @if($firstFeatured)
						@if($firstFeatured->categories->isNotEmpty())
							<span class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-full mb-4">
								<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
								</svg>
								{{ $firstFeatured->categories->first()->name }}
							</span>
						@endif
						<h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
							{{ $firstFeatured->title }}
						</h1>
						<p class="text-lg md:text-xl text-gray-200 mb-6 line-clamp-2">
							{{ $firstFeatured->excerpt ?? Str::limit(strip_tags($firstFeatured->content), 150) }}
						</p>
						<div class="flex items-center space-x-6 text-sm text-gray-300 mb-6">
							<span class="flex items-center">
								<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
								{{ $firstFeatured->published_at?->format('d M Y') }}
							</span>
							@if(isset($firstFeatured->reading_time))
								<span class="flex items-center">
									<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
									</svg>
									{{ $firstFeatured->reading_time }} dk okuma
								</span>
							@endif
						</div>
						<a href="{{ $routePostsShow ? route('posts.show', $firstFeatured->slug ?? $firstFeatured->id) : '#' }}" class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-semibold rounded-full hover:bg-gray-100 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
							Devamını Oku
							<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
							</svg>
						</a>
					@else
						<h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
							Keşfet, Öğren, İlham Al
						</h1>
						<p class="text-xl text-gray-200 mb-8">
							En güncel içerikler, trendler ve uzman görüşleri burada
						</p>
					@endif
				</div>
			</div>
		</div>
	</section>

	{{-- FEATURED ARTICLES --}}
	@if($featuredPosts->count() > 1)
		<section class="mb-20">
			<div class="flex items-center justify-between mb-8">
				<h2 class="text-3xl md:text-4xl font-bold text-gray-900 flex items-center">
					<span class="w-2 h-8 bg-blue-600 rounded-full mr-4"></span>
					Öne Çıkan Yazılar
				</h2>
				<a href="#" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center group">
					Tümünü Gör
					<svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
					</svg>
				</a>
			</div>
			
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				@foreach ($featuredPosts->skip(1) as $post)
					@php $img = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
					<article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
						<a href="{{ route('posts.show', $post->slug ?? $post->id) }}" class="block relative h-56 overflow-hidden">
						@if($img)
								<img src="{{ $img->url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $img->alt }}">
							@else
								<div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500"></div>
							@endif
							<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
							
							@if($post->categories->isNotEmpty())
								<span class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-bold rounded-full">
									{{ $post->categories->first()->name }}
								</span>
							@endif
						</a>
						
						<div class="p-6">
							<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="block">
								<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
									{{ $post->title }}
								</h3>
							</a>
							<p class="text-gray-600 line-clamp-3 mb-4">
								{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
							</p>
							
							<div class="flex items-center justify-between text-sm text-gray-500">
								<span class="flex items-center">
									<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
									</svg>
									{{ $post->published_at?->format('d.m.Y') }}
								</span>
								@if(isset($post->reading_time))
									<span class="flex items-center">
										<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
										</svg>
										{{ $post->reading_time }} dk
									</span>
								@endif
							</div>
						</div>
					</article>
				@endforeach
			</div>
		</section>
	@endif

	{{-- LATEST POSTS & SIDEBAR --}}
	<section class="mb-20">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
			{{-- Latest Posts --}}
			<div class="lg:col-span-2">
				<div class="flex items-center justify-between mb-8">
					<h2 class="text-3xl md:text-4xl font-bold text-gray-900 flex items-center">
						<span class="w-2 h-8 bg-blue-600 rounded-full mr-4"></span>
						Son Yazılar
					</h2>
				</div>
				
				{{-- Category Filter --}}
				<div class="flex gap-3 mb-8 overflow-x-auto pb-2">
					<button class="px-5 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold whitespace-nowrap hover:bg-blue-700 transition-colors">
						Tümü
					</button>
					@foreach($topCategories->take(4) as $cat)
						<button class="px-5 py-2 bg-white text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap hover:bg-gray-100 transition-colors border border-gray-200">
							{{ $cat->name }}
						</button>
					@endforeach
				</div>

				<div class="space-y-6">
					@forelse ($latestPosts as $post)
						@php $img = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
						<article class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col sm:flex-row">
						<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="relative w-full sm:w-64 h-48 sm:h-auto flex-shrink-0 overflow-hidden">
								@if($img)
									<img src="{{ $img->url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $img->alt }}">
								@else
									<div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400"></div>
								@endif
								<div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
							</a>
							
							<div class="p-6 flex flex-col justify-between flex-grow">
								<div>
									@if($post->categories->isNotEmpty())
										<span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full mb-3">
											{{ $post->categories->first()->name }}
										</span>
									@endif
									
							<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="block">
										<h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
											{{ $post->title }}
										</h3>
									</a>
									
									<p class="text-gray-600 line-clamp-2 mb-4">
										{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 140) }}
									</p>
								</div>
								
								<div class="flex items-center justify-between">
									<div class="flex items-center space-x-4 text-sm text-gray-500">
										<span class="flex items-center">
											<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
											</svg>
											{{ $post->published_at?->format('d.m.Y') }}
										</span>
										@if(isset($post->reading_time))
											<span class="flex items-center">
												<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
												</svg>
												{{ $post->reading_time }} dk
											</span>
										@endif
									</div>
							<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="text-blue-600 font-semibold text-sm hover:text-blue-700 flex items-center group">
										Oku
										<svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
										</svg>
									</a>
								</div>
							</div>
						</article>
					@empty
						<div class="text-center py-12 bg-white rounded-2xl">
							<svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
							</svg>
							<p class="text-gray-500 text-lg">Henüz yazı bulunmuyor</p>
						</div>
					@endforelse
				</div>
			</div>

			{{-- Sidebar --}}
			<div class="space-y-8">
				{{-- Popular Posts --}}
				@if($popularPosts->count())
					<div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
						<h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
							<svg class="w-6 h-6 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
								<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
							</svg>
							Popüler Yazılar
						</h3>
						<div class="space-y-4">
							@foreach($popularPosts as $index => $post)
								<a href="{{ $routePostsShow ? route('posts.show', $post->slug ?? $post->id) : '#' }}" class="flex items-start space-x-3 group">
									<span class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
										{{ $index + 1 }}
									</span>
									<div class="flex-grow">
										<h4 class="font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors mb-1">
											{{ $post->title }}
										</h4>
										<div class="flex items-center text-xs text-gray-500">
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
				@endif

				{{-- Categories --}}
				@if($topCategories->count())
					<div class="bg-white rounded-2xl p-6 shadow-lg">
						<h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
							<svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
							</svg>
							Kategoriler
						</h3>
						<div class="space-y-3">
							@foreach($topCategories as $cat)
								<a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors group">
									<span class="font-medium text-gray-700 group-hover:text-blue-600 transition-colors">
										{{ $cat->name }}
									</span>
									<span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-semibold">
										{{ $cat->posts_count }}
									</span>
								</a>
							@endforeach
						</div>
					</div>
				@endif

				{{-- Newsletter --}}
				<div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl p-6 text-white shadow-xl">
					<div class="text-center mb-6">
						<svg class="w-12 h-12 mx-auto mb-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
						</svg>
						<h3 class="text-xl font-bold mb-2">Bültene Abone Ol</h3>
						<p class="text-sm text-blue-100">Yeni içeriklerden ilk sen haberdar ol!</p>
					</div>
					<form class="space-y-3">
						<input type="email" placeholder="Email adresiniz" class="w-full px-4 py-3 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
						<button type="submit" class="w-full bg-white text-blue-600 font-bold py-3 rounded-xl hover:bg-gray-100 transition-colors shadow-lg">
							Abone Ol
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	{{-- UPCOMING EVENTS --}}
	@if($upcomingEvents->count())
		<section class="mb-20">
			<div class="flex items-center justify-between mb-8">
				<h2 class="text-3xl md:text-4xl font-bold text-gray-900 flex items-center">
					<span class="w-2 h-8 bg-blue-600 rounded-full mr-4"></span>
					Yaklaşan Etkinlikler
				</h2>
			</div>
			
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
				@foreach($upcomingEvents as $event)
					<article class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-blue-600">
						<div class="flex items-center space-x-3 mb-4">
							<div class="flex-shrink-0 w-16 h-16 bg-blue-600 rounded-xl flex flex-col items-center justify-center text-white">
								<span class="text-2xl font-bold">{{ $event->event_date?->format('d') }}</span>
								<span class="text-xs uppercase">{{ $event->event_date?->format('M') }}</span>
							</div>
							<div class="flex-grow">
								<div class="text-sm text-gray-500 mb-1">
									{{ $event->event_date?->format('H:i') }}
								</div>
								<h3 class="font-bold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition-colors">
									{{ $event->title }}
								</h3>
							</div>
						</div>
						<p class="text-gray-600 line-clamp-3 mb-4">
							{{ Str::limit(strip_tags($event->description), 120) }}
						</p>
						<a href="#" class="inline-flex items-center text-blue-600 font-semibold text-sm hover:text-blue-700">
							Detaylar
							<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
						</a>
					</article>
				@endforeach
			</div>
		</section>
	@endif

	{{-- RECENT COMMENTS --}}
	@if($recentComments->count())
		<section class="mb-20">
			<div class="flex items-center justify-between mb-8">
				<h2 class="text-3xl md:text-4xl font-bold text-gray-900 flex items-center">
					<span class="w-2 h-8 bg-blue-600 rounded-full mr-4"></span>
					Son Yorumlar
				</h2>
			</div>
			
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				@foreach($recentComments as $comment)
					<div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
						<div class="flex items-start space-x-4">
							<div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
								{{ substr($comment->user_name ?? 'A', 0, 1) }}
							</div>
							<div class="flex-grow">
								<div class="flex items-center justify-between mb-2">
									<h4 class="font-semibold text-gray-900">{{ $comment->user_name ?? 'Anonim' }}</h4>
									<span class="text-xs text-gray-500">{{ $comment->created_at?->diffForHumans() }}</span>
								</div>
								<p class="text-gray-600 mb-3 line-clamp-3">
									{{ $comment->content }}
								</p>
								@if($comment->post)
									<a href="{{ $routePostsShow ? route('posts.show', $comment->post->slug ?? $comment->post->id) : '#' }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
										{{ $comment->post->title }}
									</a>
								@endif
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</section>
	@endif
@endsection