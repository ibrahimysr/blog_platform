@extends('layouts.app')

@section('title', $post->title)

@section('content')
	{{-- Hero Section --}}
	<div class="relative bg-gradient-to-br from-gray-50 via-white to-blue-50 rounded-3xl p-8 md:p-12 mb-12 overflow-hidden">
		<div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-30 -mr-32 -mt-32"></div>
		<div class="absolute bottom-0 left-0 w-48 h-48 bg-purple-100 rounded-full filter blur-3xl opacity-30 -ml-24 -mb-24"></div>
		
		<div class="relative">
			{{-- Breadcrumb --}}
			<nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
				<a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Ana Sayfa</a>
				<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
				</svg>
				<a href="{{ route('posts.list') }}" class="hover:text-blue-600 transition-colors">Yazılar</a>
				<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
				</svg>
				<span class="text-gray-900 font-medium">{{ $post->title }}</span>
			</nav>

			{{-- Categories --}}
			@if($post->categories->isNotEmpty())
				<div class="flex flex-wrap gap-2 mb-4">
					@foreach($post->categories as $category)
						<span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/95 backdrop-blur-sm text-gray-900 text-xs font-bold rounded-full shadow-lg border border-gray-200">
							<span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
							{{ $category->name }}
						</span>
					@endforeach
				</div>
			@endif

			{{-- Title --}}
			<h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 leading-tight">
				{{ $post->title }}
			</h1>

			{{-- Meta Info --}}
			<div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
				@if($post->user)
					<div class="flex items-center gap-2">
						<div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
							{{ substr($post->user->name, 0, 1) }}
						</div>
						<span class="font-medium">{{ $post->user->name }}</span>
					</div>
				@endif
				
				<div class="flex items-center gap-1">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
					</svg>
					<span>{{ $post->published_at?->format('d M Y') }}</span>
				</div>

				@if(isset($post->reading_time))
					<div class="flex items-center gap-1">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
						</svg>
						<span>{{ $post->reading_time }} dk okuma</span>
					</div>
				@endif

				<div class="flex items-center gap-1">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
					</svg>
					<span>{{ number_format($post->views) }} görüntülenme</span>
				</div>

				<div class="flex items-center gap-2 ml-auto">
					<div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-50 text-green-700">
						<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/></svg>
						<span>{{ $post->likes_count ?? 0 }}</span>
					</div>
					<div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-700">
						<svg class="w-4 h-4 rotate-180" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/></svg>
						<span>{{ $post->dislikes_count ?? 0 }}</span>
					</div>
					@if(auth()->check())
						<form method="POST" action="{{ route('posts.react', $post) }}">
							@csrf
							<input type="hidden" name="value" value="1">
							<button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-50 text-green-700 hover:bg-green-100">
								<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/></svg>
								<span>Beğen</span>
							</button>
						</form>
						<form method="POST" action="{{ route('posts.react', $post) }}">
							@csrf
							<input type="hidden" name="value" value="-1">
							<button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100">
								<svg class="w-4 h-4 rotate-180" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/></svg>
								<span>Beğenme</span>
							</button>
						</form>
					@else
						<a href="{{ route('login') }}" class="text-sm text-blue-600 underline">Giriş yaparak oy ver</a>
					@endif
				</div>
			</div>
		</div>
	</div>

	{{-- Main Content --}}
	<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
		{{-- Article Content --}}
		<article class="lg:col-span-3">
			{{-- Featured Image --}}
			@php $featuredImage = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
			@if($featuredImage)
				<div class="relative mb-8 rounded-2xl overflow-hidden shadow-xl">
					<img src="{{ $featuredImage->url }}" 
					     alt="{{ $featuredImage->alt ?? $post->title }}" 
					     class="w-full h-64 md:h-96 object-cover">
					@if($featuredImage->caption)
						<div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
							<p class="text-white text-sm">{{ $featuredImage->caption }}</p>
						</div>
					@endif
				</div>
			@endif

			{{-- Excerpt --}}
			@if($post->excerpt)
				<div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 mb-8 border-l-4 border-blue-500">
					<p class="text-lg text-gray-700 leading-relaxed font-medium">{{ $post->excerpt }}</p>
				</div>
			@endif

			{{-- Content --}}
			<div class="prose prose-lg max-w-none">
				{!! $post->content !!}
			</div>

			{{-- Additional Media --}}
			@if($post->media->count() > 1)
				<div class="mt-8">
					<h3 class="text-xl font-bold text-gray-900 mb-4">Galeri</h3>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						@foreach($post->media->where('is_primary', false) as $media)
							<div class="relative rounded-xl overflow-hidden shadow-lg">
								<img src="{{ $media->url }}" 
								     alt="{{ $media->alt }}" 
								     class="w-full h-48 object-cover">
								@if($media->caption)
									<div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
										<p class="text-white text-sm">{{ $media->caption }}</p>
									</div>
								@endif
							</div>
						@endforeach
					</div>
				</div>
			@endif

			{{-- Tags/Categories --}}
			@if($post->categories->isNotEmpty())
				<div class="mt-8 pt-8 border-t border-gray-200">
					<h3 class="text-lg font-bold text-gray-900 mb-4">Kategoriler</h3>
					<div class="flex flex-wrap gap-2">
						@foreach($post->categories as $category)
							<a href="{{ route('posts.list', ['category' => $category->id]) }}" 
							   class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-700 rounded-full text-sm font-medium transition-all">
								<span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
								{{ $category->name }}
							</a>
						@endforeach
					</div>
				</div>
			@endif

			{{-- Comments Section --}}
			<div class="mt-12 pt-8 border-t border-gray-200">
				<h3 class="text-2xl font-bold text-gray-900 mb-6">Yorumlar ({{ $post->comments->where('status',1)->count() }})</h3>
				@if($post->comments->where('status',1)->isNotEmpty())
					<div class="space-y-6">
						@foreach($post->comments->where('status', 1) as $comment)
							<div class="bg-gray-50 rounded-2xl p-6">
								<div class="flex items-start gap-4">
									<div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
										{{ substr($comment->user->name, 0, 1) }}
									</div>
									<div class="flex-1">
										<div class="flex items-center gap-2 mb-2">
											<span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
											<span class="text-sm text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</span>
										</div>
										<p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@else
					<div class="bg-gray-50 rounded-2xl p-6 text-gray-600">Henüz yorum yok. İlk yorumu sen yaz.</div>
				@endif

				@if(auth()->check())
					<div class="mt-8">
						<form method="POST" action="{{ route('posts.comment.store', $post) }}" class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
							@csrf
							<label class="block text-sm font-medium text-gray-700 mb-2">Yorumun</label>
							<textarea name="content" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Düşüncelerini paylaş...">{{ old('content') }}</textarea>
							<div class="mt-3 flex items-center justify-between">
								@if($errors->has('content'))
									<span class="text-sm text-red-600">{{ $errors->first('content') }}</span>
								@endif
								<button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-5 py-2 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700">Gönder</button>
							</div>
						</form>
					</div>
				@else
					<div class="mt-6 bg-blue-50 text-blue-800 px-6 py-4 rounded-xl">Yorum eklemek için lütfen <a class="underline" href="{{ route('login') }}">giriş yap</a>.</div>
				@endif
			</div>
		</article>

		{{-- Sidebar --}}
		<aside class="space-y-6">
			{{-- Author Card --}}
			@if($post->user)
				<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
					<div class="text-center">
						<div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">
							{{ substr($post->user->name, 0, 1) }}
						</div>
						<h3 class="text-lg font-bold text-gray-900 mb-1">{{ $post->user->name }}</h3>
						<p class="text-sm text-gray-500 mb-4">Yazar</p>
						<button class="w-full bg-gradient-to-r from-blue-500 to-purple-500 text-white py-2 px-4 rounded-xl font-medium hover:from-blue-600 hover:to-purple-600 transition-all">
							Takip Et
						</button>
					</div>
				</div>
			@endif

			{{-- Related Posts --}}
			@if($relatedPosts->isNotEmpty())
				<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
					<h3 class="text-lg font-bold text-gray-900 mb-4">İlgili Yazılar</h3>
					<div class="space-y-4">
						@foreach($relatedPosts as $relatedPost)
							@php $img = $relatedPost->media->firstWhere('is_primary', true) ?: $relatedPost->media->first(); @endphp
							<a href="{{ route('posts.show', $relatedPost) }}" class="block group">
								<div class="flex gap-3">
									@if($img)
										<img src="{{ $img->url }}" 
										     alt="{{ $relatedPost->title }}" 
										     class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
									@else
										<div class="w-16 h-16 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex-shrink-0 flex items-center justify-center">
											<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
											</svg>
										</div>
									@endif
									<div class="flex-1 min-w-0">
										<h4 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 mb-1">
											{{ $relatedPost->title }}
										</h4>
										<p class="text-xs text-gray-500">{{ $relatedPost->published_at?->format('d M Y') }}</p>
									</div>
								</div>
							</a>
						@endforeach
					</div>
				</div>
			@endif

			{{-- Newsletter --}}
			<div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-purple-700 rounded-2xl p-6 shadow-xl overflow-hidden">
				<div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
				<div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
				
				<div class="relative">
					<div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
						</svg>
					</div>
					<h3 class="text-xl font-bold text-white mb-2">Bültene Abone Ol</h3>
					<p class="text-blue-100 text-sm mb-5 leading-relaxed">Benzer yazılardan ilk siz haberdar olun.</p>
					<form class="space-y-3">
						<input type="email" 
						       placeholder="E-posta adresiniz" 
						       class="w-full px-4 py-3 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white/50 bg-white/95 backdrop-blur-sm shadow-lg text-sm">
						<button class="w-full bg-white text-blue-700 font-bold py-3 rounded-xl hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 text-sm">
							Abone Ol →
						</button>
					</form>
				</div>
			</div>
		</aside>
	</div>
@endsection
