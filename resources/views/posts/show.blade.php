@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
	{{-- Animated Background Elements --}}
	<div class="fixed inset-0 overflow-hidden pointer-events-none">
		<div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
		<div class="absolute top-40 right-10 w-72 h-72 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
		<div class="absolute bottom-20 left-1/2 w-72 h-72 bg-pink-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
	</div>

	<div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		{{-- Breadcrumb --}}
		<nav class="flex items-center gap-2 text-sm mb-6 backdrop-blur-sm">
			<a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105">Ana Sayfa</a>
			<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
			</svg>
			<a href="{{ route('posts.list') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105">Bloglar</a>
			<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
			</svg>
			<span class="text-gray-900 font-semibold">{{ Str::limit($post->title, 40) }}</span>
		</nav>

		<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
			{{-- Main Content --}}
			<div class="lg:col-span-8">
				{{-- Hero Card --}}
				<article class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 hover:shadow-blue-500/10 transition-all duration-500">
					{{-- Featured Image with Overlay --}}
					@php $featuredImage = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
					@if($featuredImage)
						<div class="relative h-[400px] overflow-hidden group">
							<img src="{{ $featuredImage->url }}" 
							     alt="{{ $featuredImage->alt ?? $post->title }}" 
							     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
							<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
							
							{{-- Floating Category Badges --}}
							@if($post->categories->isNotEmpty())
								<div class="absolute top-6 left-6 flex flex-wrap gap-2">
									@foreach($post->categories->take(3) as $category)
										<span class="px-4 py-2 bg-white/95 backdrop-blur-md text-gray-900 text-xs font-bold rounded-full shadow-lg border border-white/50 hover:scale-105 transition-transform duration-300">
											{{ $category->name }}
										</span>
									@endforeach
								</div>
							@endif

							{{-- Title Overlay --}}
							<div class="absolute bottom-0 left-0 right-0 p-8">
								<h1 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight drop-shadow-2xl">
									{{ $post->title }}
								</h1>
								
								{{-- Meta Info --}}
								<div class="flex flex-wrap items-center gap-4 text-white/90">
									@if($post->user)
										<div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
											<div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
												{{ substr($post->user->name, 0, 1) }}
											</div>
											<span class="font-semibold">{{ $post->user->name }}</span>
										</div>
									@endif
									
									<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
										</svg>
										<span class="text-sm">{{ $post->published_at?->format('d M Y') }}</span>
									</div>

									@if(isset($post->reading_time))
										<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
											</svg>
											<span class="text-sm">{{ $post->reading_time }} dk</span>
										</div>
									@endif

									<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
										</svg>
										<span class="text-sm">{{ number_format($post->views) }}</span>
									</div>
								</div>
							</div>
						</div>
					@endif

					{{-- Content Section --}}
					<div class="p-8 md:p-12">
						{{-- Excerpt --}}
						@if($post->excerpt)
							<div class="relative mb-8 p-6 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 rounded-2xl border-l-4 border-blue-500 shadow-sm">
								<div class="absolute top-4 right-4 text-blue-200">
									<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
										<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
									</svg>
								</div>
								<p class="text-lg text-gray-700 leading-relaxed font-medium relative z-10">{{ $post->excerpt }}</p>
							</div>
						@endif

						{{-- Like/Dislike Actions --}}
						<div class="flex items-center justify-between mb-8 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl">
							<div class="flex items-center gap-4">
								<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm">
									<svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
										<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
									</svg>
									<span class="font-bold text-gray-900">{{ $post->likes_count ?? 0 }}</span>
								</div>
								<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm">
									<svg class="w-5 h-5 text-red-600 rotate-180" viewBox="0 0 24 24" fill="currentColor">
										<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
									</svg>
									<span class="font-bold text-gray-900">{{ $post->dislikes_count ?? 0 }}</span>
								</div>
							</div>

							@if(auth()->check())
								<div class="flex items-center gap-3">
									<form method="POST" action="{{ route('posts.react', $post) }}">
										@csrf
										<input type="hidden" name="value" value="1">
										<button class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
											<svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor">
												<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
											</svg>
											<span>Beğen</span>
										</button>
									</form>
									<form method="POST" action="{{ route('posts.react', $post) }}">
										@csrf
										<input type="hidden" name="value" value="-1">
										<button class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
											<svg class="w-5 h-5 rotate-180 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor">
												<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
											</svg>
											<span>Beğenme</span>
										</button>
									</form>
								</div>
							@else
								<a href="{{ route('login') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
									Oy vermek için giriş yap
								</a>
							@endif
						</div>

						{{-- Main Content --}}
						<div class="prose prose-lg prose-blue max-w-none prose-headings:font-black prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-2xl prose-img:shadow-xl">
							{!! $post->content !!}
						</div>

						{{-- Additional Media Gallery --}}
						@if($post->media->count() > 1)
							<div class="mt-12 pt-12 border-t border-gray-200">
								<h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
									<span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-purple-600 rounded-full"></span>
									Galeri
								</h3>
								<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
									@foreach($post->media->where('is_primary', false) as $media)
										<div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
											<img src="{{ $media->url }}" 
											     alt="{{ $media->alt }}" 
											     class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-700">
											<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
											@if($media->caption)
												<div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
													<p class="text-white text-sm font-medium">{{ $media->caption }}</p>
												</div>
											@endif
										</div>
									@endforeach
								</div>
							</div>
						@endif

						{{-- Categories Section --}}
						@if($post->categories->isNotEmpty())
							<div class="mt-12 pt-12 border-t border-gray-200">
								<h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
									<span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-purple-600 rounded-full"></span>
									Kategoriler
								</h3>
								<div class="flex flex-wrap gap-3">
									@foreach($post->categories as $category)
										<a href="{{ route('posts.list', ['category' => $category->id]) }}" 
										   class="group px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 hover:from-blue-600 hover:to-purple-600 text-gray-700 hover:text-white rounded-full font-semibold shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
											<span class="flex items-center gap-2">
												<span class="w-2 h-2 bg-blue-600 group-hover:bg-white rounded-full"></span>
												{{ $category->name }}
											</span>
										</a>
									@endforeach
								</div>
							</div>
						@endif
					</div>
				</article>

				{{-- Comments Section --}}
				<div class="mt-8 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
					<h3 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
						<span class="w-1.5 h-10 bg-gradient-to-b from-blue-600 to-purple-600 rounded-full"></span>
						Yorumlar
						<span class="ml-2 px-4 py-1 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 text-lg rounded-full font-bold">
							{{ $post->comments->where('status',1)->count() }}
						</span>
					</h3>

					@if($post->comments->where('status',1)->isNotEmpty())
						<div class="space-y-4 mb-8">
							@foreach($post->comments->where('status', 1) as $comment)
								<div class="group bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100">
									<div class="flex items-start gap-4">
										<div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center text-white font-bold shadow-lg flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
											{{ substr($comment->user->name, 0, 1) }}
										</div>
										<div class="flex-1 min-w-0">
											<div class="flex items-center gap-3 mb-2 flex-wrap">
												<span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
												<span class="text-sm text-gray-500 flex items-center gap-1">
													<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
													</svg>
													{{ $comment->created_at->format('d M Y, H:i') }}
												</span>
											</div>
											<p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					@else
						<div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 text-center mb-8 border border-gray-200">
							<svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
							</svg>
							<p class="text-gray-600 font-medium">Henüz yorum yok. İlk yorumu sen yap! 💬</p>
						</div>
					@endif

					@if(auth()->check())
						<form method="POST" action="{{ route('posts.comment.store', $post) }}" class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 rounded-2xl p-6 shadow-lg border border-white">
							@csrf
							<label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
								<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
								</svg>
								Yorumunu Yaz
							</label>
							<textarea name="content" rows="4" 
							          class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-white shadow-sm" 
							          placeholder="Düşüncelerini bizimle paylaş...">{{ old('content') }}</textarea>
							<div class="mt-4 flex items-center justify-between">
								@if($errors->has('content'))
									<span class="text-sm text-red-600 font-medium">{{ $errors->first('content') }}</span>
								@else
									<span></span>
								@endif
								<button class="group px-8 py-3 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white rounded-xl font-bold shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
									<span>Gönder</span>
									<svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
									</svg>
								</button>
							</div>
						</form>
					@else
						<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-6 rounded-2xl shadow-xl text-center">
							<p class="text-lg font-semibold mb-3">Yorum yapmak için giriş yapmalısın</p>
							<a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-white text-blue-600 rounded-xl font-bold hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
								Giriş Yap
							</a>
						</div>
					@endif
				</div>
			</div>

			{{-- Sidebar --}}
			<aside class="lg:col-span-4 space-y-6">
				{{-- Author Card --}}
				@if($post->user)
					<div class="sticky top-6 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 hover:shadow-blue-500/10 transition-all duration-500">
						<div class="relative h-32 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 overflow-hidden">
							<div class="absolute inset-0 opacity-20">
								<div class="absolute top-0 left-0 w-full h-full bg-white/10 rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
							</div>
						</div>
						<div class="relative px-6 pb-6 -mt-16 text-center">
							<div class="w-24 h-24 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white text-3xl font-black mx-auto mb-4 shadow-2xl border-4 border-white transform hover:scale-110 transition-transform duration-300">
								{{ substr($post->user->name, 0, 1) }}
							</div>
							<h3 class="text-xl font-black text-gray-900 mb-1">{{ $post->user->name }}</h3>
							<p class="text-sm text-gray-500 mb-6 font-medium">✍️ Blog Yazarı</p>
							<button class="w-full py-3 px-6 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-bold shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
								<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
								</svg>
								<span>Takip Et</span>
							</button>
						</div>
					</div>
				@endif

				{{-- Related Posts --}}
				@if($relatedPosts->isNotEmpty())
					<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-6">
						<h3 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-3">
							<span class="w-1 h-6 bg-gradient-to-b from-blue-600 to-purple-600 rounded-full"></span>
							İlgili Bloglar
						</h3>
						<div class="space-y-4">
							@foreach($relatedPosts as $relatedPost)
								@php $img = $relatedPost->media->firstWhere('is_primary', true) ?: $relatedPost->media->first(); @endphp
								<a href="{{ route('posts.show', $relatedPost) }}" class="group block">
									<div class="flex gap-4 p-3 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300">
										@if($img)
											<img src="{{ $img->url }}" 
											     alt="{{ $relatedPost->title }}" 
											     class="w-20 h-20 object-cover rounded-xl flex-shrink-0 shadow-md group-hover:shadow-xl group-hover:scale-105 transition-all duration-300">
										@else
											<div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex-shrink-0 flex items-center justify-center shadow-md group-hover:shadow-xl group-hover:scale-105 transition-all duration-300">
												<svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
												</svg>
											</div>
										@endif
										<div class="flex-1 min-w-0">
											<h4 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 mb-2">
												{{ $relatedPost->title }}
											</h4>
											<p class="text-xs text-gray-500 flex items-center gap-1">
												<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
												</svg>
												{{ $relatedPost->published_at?->format('d M Y') }}
											</p>
										</div>
									</div>
								</a>
							@endforeach
						</div>
					</div>
				@endif

				{{-- Newsletter --}}
				<div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 rounded-3xl p-8 shadow-2xl overflow-hidden group hover:shadow-purple-500/50 transition-all duration-500">
					<div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20 group-hover:scale-150 transition-transform duration-700"></div>
					<div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16 group-hover:scale-150 transition-transform duration-700"></div>
					<div class="absolute inset-0 bg-white/5 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
					
					<div class="relative z-10">
						<div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6 shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
							<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
							</svg>
						</div>
						<h3 class="text-2xl font-black text-white mb-3">Bültene Abone Ol</h3>
						<p class="text-blue-100 text-sm mb-6 leading-relaxed">Yeni içeriklerden ilk sen haberdar ol! 🚀</p>
						<form class="space-y-3">
							<input type="email" 
							       placeholder="E-posta adresin" 
							       class="w-full px-5 py-4 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-white/50 bg-white shadow-xl text-sm font-medium transition-all duration-300">
							<button class="w-full bg-white text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 font-black py-4 rounded-xl hover:bg-gray-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 active:translate-y-0 text-sm flex items-center justify-center gap-2 group/btn">
								<span>Abone Ol</span>
								<svg class="w-5 h-5 text-blue-600 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
								</svg>
							</button>
						</form>
					</div>
				</div>

				{{-- Share Social --}}
				<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-6">
					<h3 class="text-lg font-black text-gray-900 mb-4 flex items-center gap-3">
						<span class="w-1 h-6 bg-gradient-to-b from-blue-600 to-purple-600 rounded-full"></span>
						Paylaş
					</h3>
					<div class="grid grid-cols-2 gap-3">
						<button class="flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
								<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
							</svg>
							<span class="text-sm">Facebook</span>
						</button>
						<button class="flex items-center justify-center gap-2 px-4 py-3 bg-sky-500 text-white rounded-xl font-semibold hover:bg-sky-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
								<path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
							</svg>
							<span class="text-sm">Twitter</span>
						</button>
						<button class="flex items-center justify-center gap-2 px-4 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
								<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
							</svg>
							<span class="text-sm">WhatsApp</span>
						</button>
						<button class="flex items-center justify-center gap-2 px-4 py-3 bg-gray-700 text-white rounded-xl font-semibold hover:bg-gray-800 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
							</svg>
							<span class="text-sm">Kopyala</span>
						</button>
					</div>
				</div>
			</aside>
		</div>
	</div>
</div>

<style>
@keyframes blob {
	0%, 100% { transform: translate(0, 0) scale(1); }
	25% { transform: translate(20px, -20px) scale(1.1); }
	50% { transform: translate(-20px, 20px) scale(0.9); }
	75% { transform: translate(20px, 20px) scale(1.05); }
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
</style>

@endsection